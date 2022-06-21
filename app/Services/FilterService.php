<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;

class FilterService
{
    public function getProducts(Request $request)
    {
        $products = $this->priceVerification($request);
        return $this->filtersVerification($request, $products);
    }

    public function filtersVerification(Request $request, $products)
    {
        $result = [];
        foreach (['new' => 'isNew', 'recommend' => 'isRecommend', 'popular' => 'isPopular'] as $filter => $verification) {
            if ($request->has($filter) and $request->$filter == 'on') {
                foreach ($products as $product){
                    if ($product->$verification()){
                        $result[] = $product;
                    }
                }
            }
        }

        if (empty($result)){
            $result = $products;
        }
        return $result;
    }

    public function priceVerification(Request $request)
    {
        $products = Product::get();
        $currency = Currency::getCurrencyNow();
        if($request->has('price_from') and $request->price_from !== null){
             $products = $products->where('price', '>=', $currency->convertToBase($request->price_from));
        }

        if($request->has('price_to') and $request->price_to !== null){
            $products = $products->where('price', '<=', $currency->convertToBase($request->price_to));
        }

        return $products;
    }

    public function getActiveFilters(Request $request): array
    {
        $filters = [];
        foreach (['new', 'recommend', 'popular', 'price_from', 'price_to'] as $filter){
            if ($request->has($filter) and $request->$filter == 'on'){
                $filters[] = $filter;
            }
            if ($request->has($filter) and $request->$filter !== 'on'){
                $filters[$filter] = $request->$filter;
            }
        }
        return $filters;
    }
}
