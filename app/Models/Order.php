<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function store($data)
    {
        $newData = $this->dataPreparation($data);

        foreach (Cart::getCart() as $cart) {
            $product = Product::findOrFail($cart['product_id']);
            if (!$product->countRemove($cart['quantity'])) {
                return false;
            }
            $product->sales = $product->sales + $cart['quantity'];
            $product->save();
        }

        self::create($newData);

        $this->createPivot();

        session()->regenerate();

        session()->flash('success', 'Заказ успешно оформлен, ожидайте сообщения на электронную почту');
    }

    private function createPivot()
    {
        $lastOrder = self::orderby('id', 'desc')->first();
        foreach (Cart::getProductsIds() as $productId) {
            $this->products()->attach($productId, ['order_id' => $lastOrder->id]);
        }
    }

    private function dataPreparation($data)
    {
        $newData = [
            'session_id' => session()->getId(),
            'email' => $data['email'],
            'sum' => $data['sum'],
            'currency_symbol' => Currency::getCurrencyNow()->symbol,
            'city' => $data['city'],
            'address' => $data['address'],
            'index' => $data['index'],
            'coupon_id' => session('coupon_id'),
        ];
        session()->forget('coupon_id');
        if (Auth::check()) {
            $newData['user_id'] = Auth::user()->id;
        }

        return $newData;
    }
}
