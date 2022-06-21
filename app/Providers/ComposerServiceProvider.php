<?php

namespace App\Providers;

use App\Http\ViewComposers\CurrenciesComposer;
use App\Http\ViewComposers\CurrencyComposer;
use App\Http\ViewComposers\SubscriberComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', CurrenciesComposer::class);
        view()->composer('*', CurrencyComposer::class);
        view()->composer('main.product', SubscriberComposer::class);
    }
}
