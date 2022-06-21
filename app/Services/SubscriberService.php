<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriberService
{
    public function create(Request $request, Product $product)
    {
        Subscriber::create([
            'email' => $request->email,
            'product_id' => $product->id,
        ]);
        session()->flash('success', "Вы подписались на рассылку о $product->name");
    }

    public function delete(Request $request, Product $product)
    {
        $subscriber = Subscriber::where('email', $request->email)->where('product_id', $product->id)->first();
        $subscriber->delete();
        session()->flash('warning', "Подписка на $product->name отменена");
    }

    public function getProducts(): array
    {
        $user = Auth::user();
        $subscribers = Subscriber::getSubscribersByEmail($user->email);
        $products = [];
        foreach ($subscribers as $subscriber){
            $products[] = $subscriber->product;
        }
        return $products;
    }
}
