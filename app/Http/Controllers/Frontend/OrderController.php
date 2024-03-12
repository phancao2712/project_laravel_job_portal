<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index() : View {
        $orders = Order::where('company_id', auth()->user()->company->id)->paginate(20);
        return view('frontend.company-dashboard.order.index', compact(
            'orders'
        ));
    }
}
