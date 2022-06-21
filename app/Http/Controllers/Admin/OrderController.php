<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Currency;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(): Factory|View|Application
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order): Factory|View|Application
    {
        $quantity = Cart::getProductsQuantity($order);
        $currencyOrder = Currency::where('symbol', $order->currency_symbol)->first();
        return view('admin.order.show', compact('order', 'currencyOrder', 'quantity'));
    }

    public function treatment(Order $order): RedirectResponse
    {
        $order->status = 1;
        $order->save();
        session()->flash('success', "Заказ $order->id обработан");
        return redirect()->route('admin.orders.index');
    }
}
