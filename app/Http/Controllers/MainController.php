<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MainController extends Controller
{
    public function index(Product $product): Factory|View|Application
    {
        $products = $product->paginate(9);
        return view('main.index', compact('products'));
    }

    public function product(Product $product): Factory|View|Application
    {
        return view('main.product', compact('product'));
    }

    public function categories(Category $category): Factory|View|Application
    {
        $categories = $category->paginate(5);
        return view('main.categories', compact('categories'));
    }

    public function products(Category $category, Product $product): Factory|View|Application
    {
        $categories = $category->get();
        $products = $product->paginate(8);
        return view('main.products', compact('categories', 'products'));
    }

    public function productsFromCategory(Category $category): Factory|View|Application
    {
        $categories = $category->get();
        $products = $category->products()->paginate(8);
        return view('main.products', compact('categories', 'products'));
    }

    public function locale($locale): RedirectResponse
    {
        session(['locale' => $locale]);
        return redirect()->back();
    }

    public function useFilters(Request $request, FilterService $service): Factory|View|Application
    {
        $products = $service->getProducts($request);
        $activeFilters = $service->getActiveFilters($request);
        return view('main.index', compact(['products', 'service', 'activeFilters']));
    }

}
