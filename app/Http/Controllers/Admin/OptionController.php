<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modifier;
use App\Models\Option;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function create(Modifier $modifier): Factory|View|Application
    {
        return view('admin.option.form', compact('modifier'));
    }

    public function store(Request $request, Modifier $modifier): RedirectResponse
    {
        Option::create([
            'modifier_id' => $modifier->id,
            'name' => $request->name,
        ]);
        session()->flash('success', 'Опция добавлена');
        return redirect()->route('modifiers.show', $modifier);
    }

    public function delete(Option $option): RedirectResponse
    {
        $option->delete();
        return redirect()->route('modifiers.show', $option->modifier);
    }
}
