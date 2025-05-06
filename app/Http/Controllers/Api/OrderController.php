<?php

namespace App\Http\Controllers\Api;

use App\CommonFunctions;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends ApiController
{
    use CommonFunctions;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        try {
            $request->validate([
                'order_id_qty_price' => 'required|array',
            ]);
       
            Order::create([
                'user_id' => $request->user()->id,
                'order_id_with_qty' => $request->order_id_qty_price,
            ]);
        } catch (\Exception $e) {
            return $this->error('Something went wrong while creating order.' . $e->getMessage());
        }
    }

    public function orderHistory()
    {
        try {
            $id = request()->user()->id;
            $orders = Order::with('user:id,restaurant_name')->where('user_id', '=', $id)->orderBy('created_at', 'desc')->get();
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
            return $this->success($returnOrders, 'Order retrieved successfully.');
        } catch (\Exception $e) {
            return $this->error('Something went wrong while retrieving orders. ' . $e->getMessage());
        }
    }

}
