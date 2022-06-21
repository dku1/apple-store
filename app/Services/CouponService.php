<?php

namespace App\Services;

use App\Models\Coupon;

class CouponService
{
    private $price;
    private Coupon $coupon;

    public function __construct($price, Coupon $coupon)
    {
        $this->price = $price;
        $this->coupon = $coupon;
        if ($coupon->isDisposable()) {
            $coupon->deactivation();
        }

    }


    public function recalculation(): float|int
    {
        if ($this->coupon->isPercentage()) {
            return $this->percentageRecalculation($this->price, $this->coupon->denomination);
        } else {
            return $this->currencyRecalculation($this->price);
        }
    }


    public function percentageRecalculation($price, $interest): float|int
    {
        $discount = ($price * $interest) / 100;
        session(['coupon_id' => $this->coupon->id]);
        return round($price - $discount, 2);
    }


    public function currencyRecalculation($price)
    {
        $currency = $this->coupon->currency;
        $discount = $currency->convert($this->coupon->denomination);
        if ($price < $discount) {
            session()->flash('warning', 'Купон неприменим');
            return $price;
        }else{
            session(['coupon_id' => $this->coupon->id]);
            return round($price - $discount, 2);
        }
    }
}
