<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\CartService;

class OrderController extends Controller
{
    public function create(Request $request, CartService $service): Factory|View|Application
    {
        $totalPrice = $service->getTotalPrice($request);
        return view('order.create', compact('totalPrice'));
    }

    public function store(OrderRequest $request, Order $order): RedirectResponse
    {
        $order->store($request->all());
        return redirect()->route('index');
    }
}
