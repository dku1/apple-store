<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CartService
{
    public function getProducts(): array
    {
        $products = [];
        $cart = Cart::where('session_id', session()->getId())->get()->toArray();
        foreach ($cart as $product) {
            $products[] = [Product::findOrFail($product['product_id']), $product['quantity']];
        }
        return $products;
    }

    public function getTotalPrice(Request $request): float|int
    {
        if ($request->has('totalPrice')){
            return $request->totalPrice;
        }else{
            return Cart::totalPrice();
        }
    }

    public function redirect($cartIsset): RedirectResponse
    {
        if ($cartIsset) {
            return redirect()->route('cart.index');
        } else {
            return redirect()->route('index');
        }
    }
}
