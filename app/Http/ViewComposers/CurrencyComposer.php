<?php

namespace App\Http\ViewComposers;

use App\Models\Currency;
use Illuminate\View\View;

class CurrencyComposer
{
    public function compose(View $view): View
    {
        return $view->with('currency', new Currency);
    }
}
