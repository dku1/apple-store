<?php

namespace App\Http\ViewComposers;

use App\Models\Subscriber;
use Illuminate\View\View;

class SubscriberComposer
{
    public function compose(View $view): View
    {
        return $view->with('subscriber', new Subscriber());
    }
}
