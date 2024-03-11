<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    function index() : View
    {
        $orders = Order::paginate(20);
        return view('admin.order.index', compact(
            'orders'
        ));
    }
}
