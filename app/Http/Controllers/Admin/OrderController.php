<?php

namespace App\Http\Controllers\Admin;

use App\CommonFunctions;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    use CommonFunctions;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.orders.index');
    }

    public function getOrder()
    {
        try {
            $order = Order::orderBy('created_at', 'desc');
            return DataTables::of($order)
                ->addColumn('restaurant_name', function ($row) {
                    return $row->user->restaurant_name ?? 'N/A';
                })
                ->addColumn('actions', function ($row) {
                    $download = route('order.download', $row->id);
                    $editUrl = route('category.edit', $row->id);
                    return '
                        <div class="d-flex justify-content-center align-items-center">
                          <a href="' . $download . '" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                <i class="la la-download"></i>
                            </a>
                            <a href="' . $editUrl . '" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                <i class="la la-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-clean btn-icon btn-icon-md delete-btn"
                                data-id="' . $row->id . '">
                                <i class="la la-trash"></i>
                            </button>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        } catch (\Exception $e) {
            Log::error('Error fetching orders: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong while fetching orders.'], 500);
        }
    }
    public function orderDownload($id)
    {
        try {
            $orders = Order::with('user:id,restaurant_name')->where('id', '=', $id)->get();
            $returnOrders = [];
            foreach ($orders as $order) {
                $formatted = $this->formatOrderItems($order->order_id_with_qty);

                $returnOrders[] = [
                    'id' => $order->id,
                    'user_id' => $order->user_id,
                    'restaurant_name' => $order->user->restaurant_name,
                    'order_id_with_qty' => $formatted['order_id_with_qty'],
                    'total_qty' => $formatted['total_qty'],
                    'total_price' => $formatted['total_price'],
                    'created_at' => $order->created_at,
                ];
            }
            $data = $returnOrders[0];
            $pdf = Pdf::loadView('pdf.order', compact('data'));
            return $pdf->download($data['restaurant_name'] . '_order_' . $data['id'] . '_' . $data['created_at']->format('Y-m-d') . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error generating order PDF for ID ' . $id . ': ' . $e->getMessage());
            return response()->json(['error' => 'Failed to generate order PDF.'], 500);
        }
    }

    public function todayOrderDownload()
    {
        try {
            $startHour = (int) config('constants.start_time_hour');
            $endHour = (int) config('constants.end_time_hour');
            $startTime = Carbon::yesterday()->addHours($startHour);
            $endTime = Carbon::today()->addHours($endHour);
            $orders = Order::whereBetween('created_at', [$startTime, $endTime])->get();
            $allOrderItems = [];

            foreach ($orders as $order) {
                $formatted = $this->formatOrderItems($order->order_id_with_qty);
                if (!empty($formatted['order_id_with_qty'])) {
                    foreach ($formatted['order_id_with_qty'] as $item) {
                        $id = $item['id'];

                        if (!isset($allOrderItems[$id])) {
                            $allOrderItems[$id] = [
                                'id' => $item['id'],
                                'qty' => 0,
                                'sub_category' => $item['sub_category'],
                            ];
                        }
                        $allOrderItems[$id]['qty'] += $item['qty'];
                    }
                }
            }

            $mergedOrders = array_values($allOrderItems);
            $totalQty = array_sum(array_column($mergedOrders, 'qty'));
            $date = $endTime->format('d,F Y');
            $pdf = Pdf::loadView('pdf.today-order', compact('mergedOrders', 'date', 'totalQty'));
            return $pdf->download($date . '_order_' . '_' . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error generating today\'s order PDF: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to generate today\'s order PDF.'], 500);
        }
    }



    public function todayOrderRestaurantDownload()
    {
        try {
            $startHour = (int) config('constants.start_time_hour');
            $endHour = (int) config('constants.end_time_hour');
            $startTime = Carbon::yesterday()->addHours($startHour);
            $endTime = Carbon::today()->addHours($endHour);

            $orders = Order::whereBetween('created_at', [$startTime, $endTime])->get();
            $returnOrders = [];

            foreach ($orders as $order) {
                $formatted = $this->formatOrderItems($order->order_id_with_qty);

                $returnOrders[] = [
                    'id' => $order->id,
                    'user_id' => $order->user_id,
                    'restaurant_name' => $order->user->restaurant_name,
                    'order_id_with_qty' => $formatted['order_id_with_qty'],
                    'total_qty' => $formatted['total_qty'],
                    'created_at' => $order->created_at,
                ];
            }

            $zip = new \ZipArchive();
            $zipFileName = storage_path('app/public/orders_' . Carbon::now()->format('Y-m-d') . '.zip');

            if ($zip->open($zipFileName, \ZipArchive::CREATE) === true) {
                foreach ($returnOrders as $data) {
                    $pdf = Pdf::loadView('pdf.order', compact('data'));

                    $pdfContent = $pdf->output();
                    $pdfFileName = $data['restaurant_name'] . '_order_' . $data['id'] . '_' . $data['created_at']->format('Y-m-d') . '.pdf';
                    $zip->addFromString($pdfFileName, $pdfContent);
                }

                $zip->close();
            }

            return response()->download($zipFileName)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error('Error generating today\'s restaurant orders ZIP: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to generate ZIP file for today\'s restaurant orders.'], 500);
        }
    }
}
