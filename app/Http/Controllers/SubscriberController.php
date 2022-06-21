<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\SubscriberService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function add(Request $request, Product $product, SubscriberService $service): RedirectResponse
    {
        $service->create($request, $product);
        return redirect()->back();
    }

    public function destroy(Request $request, Product $product, SubscriberService $service): RedirectResponse
    {
        $service->delete($request, $product);
        return redirect()->back();
    }

}
