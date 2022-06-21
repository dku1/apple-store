<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modifier;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ModifierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $modifiers = Modifier::all();
        return view('admin.modifier.index', compact('modifiers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.modifier.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Modifier::create($request->all());
        session()->flash('success', "Добавлен атрибут $request->name");
        return redirect()->route('modifiers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Modifier $modifier
     * @return Application|Factory|View
     */
    public function show(Modifier $modifier): View|Factory|Application
    {
        return view('admin.modifier.show', compact('modifier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Modifier $modifier
     * @return Application|Factory|View
     */
    public function edit(Modifier $modifier): Application|Factory|View
    {
        return view('admin.modifier.form', compact('modifier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Modifier $modifier
     * @return RedirectResponse
     */
    public function update(Request $request, Modifier $modifier): RedirectResponse
    {
        $modifier->update($request->all());
        session()->flash('success', "$modifier->name изменён");
        return redirect()->route('modifiers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Modifier $modifier
     * @return RedirectResponse
     */
    public function destroy(Modifier $modifier): RedirectResponse
    {
        $modifier->delete();
        session()->flash('warning', "$modifier->name удалён");
        return redirect()->route('modifiers.index');
    }

    public function addModifierProduct(): Factory|View|Application
    {
        $products = Product::all();
        $modifiers = Modifier::all();
        return view('admin.modifier.add-modifier', compact('products', 'modifiers'));
    }

    public function addModifierProductStore(Request $request): RedirectResponse
    {
        $product = Product::find($request->product_id);
        $product->addModifiers($request->modifiers_id);
        return redirect()->route('modifiers.index');
    }
}
