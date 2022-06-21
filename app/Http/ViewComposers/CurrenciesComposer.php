<?php

namespace App\Http\ViewComposers;

use App\Models\Currency;
use Illuminate\View\View;

class CurrenciesComposer
{
    public function compose(View $view): View
    {
        return $view->with('currencies', Currency::get());
    }
}
