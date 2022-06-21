<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
    public function index(CartService $service): Factory|View|Application
    {
        $products = $service->getProducts();
        $totalPrice = Cart::totalPrice();
        return view('cart.index', compact('products', 'totalPrice'));
    }

    public function add($productId): RedirectResponse
    {
        Cart::add($productId);
        return redirect()->back();
    }

    public function remove($productId, CartService $service): RedirectResponse
    {
        $cartIsset = Cart::remove($productId);
        return $service->redirect($cartIsset);
    }

    public function applyCoupon(Request $request, CartService $service): Factory|View|Application
    {
        $products = $service->getProducts();
        $totalPrice = Cart::totalPrice($request->code);
        return view('cart.index', compact('products', 'totalPrice'));
    }
}
