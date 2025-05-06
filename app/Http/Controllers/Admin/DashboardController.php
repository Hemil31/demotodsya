<?php

namespace App\Http\Controllers\Admin;

use App\CommonFunctions;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    use CommonFunctions;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}
