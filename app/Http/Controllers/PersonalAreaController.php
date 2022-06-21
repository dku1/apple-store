<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SubscriberService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PersonalAreaRequest;

class PersonalAreaController extends Controller
{
    public function index(): Factory|View|Application
    {
        $user = Auth::user();
        return view('personalArea.index', compact('user'));
    }

    public function edit(): Factory|View|Application
    {
        $user = Auth::user();
        return view('personalArea.edit', compact('user'));
    }

    public function update(PersonalAreaRequest $request, User $user): RedirectResponse
    {
        $user->update($request->all());
        return redirect()->route('personal-area.index');
    }

    public function subscriptions(SubscriberService $service): Factory|View|Application
    {
       $products = $service->getProducts();
       return view('personalArea.subscriptions', compact('products'));
    }
}
