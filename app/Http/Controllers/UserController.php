<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Currency;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function orders(): Factory|View|Application
    {
        $orders = auth()->user()->orders()->paginate(8);
        return view('user.orders', compact('orders'));
    }

    public function orderProducts(Order $order): Factory|View|Application
    {
        $quantity = Cart::getProductsQuantity($order);
        $currencyOrder = Currency::where('symbol', $order->currency_symbol)->first();
        return view('user.order-products', compact('order', 'quantity', 'currencyOrder'));
    }
}
