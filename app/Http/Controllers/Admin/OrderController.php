<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Classes\Party;
use Illuminate\View\View;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class OrderController extends Controller
{
    use Searchable;
    function __construct(){
        $this->middleware(['permission: order index']);
    }
    function index() : View
    {
        $query = Order::query();
        $query->with(['company', 'plan']);

        $this->search($query, ['package_name', 'transaction_id', 'order_id', 'payment_provider', 'payment_status']);

        $orders = $query->paginate(20);
        return view('admin.order.index', compact(
            'orders'
        ));
    }

    function show(string $id) : View
    {
        $order = Order::findOrFail($id);
        return view('admin.order.detail', compact(
            'order'
        ));
    }

    function invoice(string $id) {
        $order = Order::findOrFail($id);
        $customer = new Buyer([
            'name'          => $order->company->name,
            'custom_fields' => [
                'email' => $order->company->email,
                'transaction no' => $order->transaction_id,
                'payment provider' => $order->payment_provider

            ],
        ]);

        $seller = new Party([
            'name'          => config('settings.site_name'),
            'custom_fields' => [
                'email' => config('settings.site_email'),
                'phone' => config('settings.site_phone')
            ],
        ]);

        $item = InvoiceItem::make($order->package_name . 'Plan')->pricePerUnit($order->amount);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->seller($seller)
            ->series($order->order_id)
            ->currencyCode($order->paid_in_currency)
            ->currencySymbol($order->paid_in_currency)
            ->status('paid')
            ->getTotalAmountInWords($order->amount)
            ->payUntilDays(0)
            ->addItem($item);

        return $invoice->download();
    }
}
