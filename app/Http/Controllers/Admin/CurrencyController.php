<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Services\Rates;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\CurrencyRequest;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        return view('admin.currency.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        return view('admin.currency.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CurrencyRequest $request
     * @return RedirectResponse
     */
    public function store(CurrencyRequest $request): RedirectResponse
    {
        Currency::create($request->all());
        session()->flash('success', "Валюта $request->code добавлена");
        return redirect()->route('currencies.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Currency $currency
     * @return Application|Factory|View
     */
    public function edit(Currency $currency): View|Factory|Application
    {
        $editCurrency = $currency;
        return view('admin.currency.form', compact('editCurrency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CurrencyRequest $request
     * @param Currency $currency
     * @return RedirectResponse
     */
    public function update(CurrencyRequest $request, Currency $currency): RedirectResponse
    {
        $currency->update($request->all());
        return redirect()->route('currencies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Currency $currency
     * @return RedirectResponse
     */
    public function destroy(Currency $currency): RedirectResponse
    {
        if ($currency->is_main !== 1){
            $currency->delete();
            session()->flash('warning', 'Валюта удалена');
        }else{
            session()->flash('warning', 'Нельзя удалить базовую валюту');
        }
        return redirect()->route('currencies.index');
    }

    public function ratesUpdate(Rates $rates): RedirectResponse
    {
        foreach (Currency::all() as $currency){
            $rates->ratesUpdate($currency);
        }
         session()->flash('success', 'Котировки обновлены');
        return redirect()->route('currencies.index');
    }
}
