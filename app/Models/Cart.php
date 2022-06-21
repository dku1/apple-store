<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\CouponService;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public static function add($productId)
    {
        $product = Product::findOrFail($productId);
        if ($cart = self::where('product_id', $productId)->where('session_id', session()->getId())->first()) {
            $cart->quantity++;
            $cart->price = $product->price;
            if ($product->available($cart->quantity)) {
                $cart->save();
                session()->flash('success', 'Кол-во товара увеличено');
            } else {
                session()->flash('warning', 'Товар недоступен в полном объёме');
            }
        } else {
            if ($product->available()) {
                self::create([
                    'session_id' => session()->getId(),
                    'product_id' => $product->id,
                    'price' => $product->price,
                ]);
                session()->flash('success', 'Товар добавлен в корзину');
            } else {
                session()->flash('warning', 'Товар недоступен в полном объёме');
            }

        }
    }

    public static function remove($productId): bool
    {
        if ($cart = self::where('product_id', $productId)->where('session_id', session()->getId())->first()) {
            if ($cart->quantity == 1) {
                $concretCart = Cart::where('id', $cart->id)->first();
                $concretCart->delete();
                session()->flash('warning', 'Товар удалён из корзины');
                if (empty(self::where('session_id', session()->getId())->get()->toArray())) {
                    $cartIsset = false;
                } else {
                    $cartIsset = true;
                }
            } else {
                $cart->quantity--;
                $cart->save();
                session()->flash('warning', 'Кол-во товара уменьшено');
                $cartIsset = true;
            }
        }

        return $cartIsset;
    }

    public static function isEmpty(): bool
    {
        if (empty(self::where('session_id', session()->getId())->get()->toArray())) {
            return true;
        } else {
            return false;
        }
    }

    public static function totalPrice($couponCode = null): float|int
    {
        $totalPrice = 0;
        $carts = self::where('session_id', session()->getId())->get()->toArray();
        foreach ($carts as $product) {
            $totalPrice += $product['quantity'] * ceil((new Currency())->convert($product['price']));
        }

        if ($couponCode !== null) {
            $coupon = Coupon::where('code', $couponCode)->active()->first();
            if ($coupon and $coupon->expirationDate()) {
                $service = new CouponService($totalPrice, $coupon);
                $totalPrice = $service->recalculation();
            } else {
                session()->flash('warning', 'Купон не активен');
            }
        }

        return $totalPrice;
    }

    public static function getProductsIds(): array
    {
        $ids = [];
        foreach (self::where('session_id', session()->getId())->get()->toArray() as $product) {
            $ids[] = $product['product_id'];
        }
        return $ids;
    }

    public static function getProductsQuantity(Order $order): array
    {
        $objectsCart = self::getBasketsFromOrder($order);
        $productsQuantity = [];
        foreach ($objectsCart as $object) {
            $productsQuantity[$object['product_id']] = $object['quantity'];
        }
        return $productsQuantity;
    }

    public static function getBasketsFromOrder(Order $order)
    {
        return self::where('session_id', $order->session_id)->get()->toArray();
    }

    public static function getCart()
    {
        return self::where('session_id', session()->getId())->get()->toArray();
    }

}
