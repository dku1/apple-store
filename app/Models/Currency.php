<?php

namespace App\Models;

use App\Services\Rates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function convert($price, $isset = false): float|int
    {
        if ($isset) {
            $currency = $this;
        } else {
            $currency = self::getCurrencyNow();
        }
        if (!(new Rates())->relevance($currency)) {
            //(new Rates())->ratesUpdate($currency);
        }
        return $price / $currency->rate;
    }

    public static function getCurrencyNow()
    {
        return self::where('code', session('currency'))->first();
    }

    public function getSymbol()
    {
        $currency = self::getCurrencyNow();
        return $currency->symbol;
    }

    public function convertToBase($price): float|int
    {
        return $price * $this->rate;
    }
}
