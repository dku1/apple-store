<?php

namespace App\Services;

use App\Models\Currency;
use Carbon\Carbon;

class Rates
{
    public function getRates()
    {
        return json_decode(file_get_contents("https://www.cbr-xml-daily.ru/daily_json.js"), true);
    }

    public function ratesUpdate(Currency $currency)
    {
        if ($currency->is_main == 0){
            $currency->update([
                'rate' => $this->getRates()['Valute']["$currency->code"]['Value'],
            ]);
        }
    }

    public function relevance(Currency $currency): bool
    {
        if ($currency->is_main == 1 || $currency->updated_at->subDays(2)->format('Y/m/d') == Carbon::now()->subDays(2)->format('Y/m/d')){
            return true;
        }else{
            return false;
        }
    }
}
