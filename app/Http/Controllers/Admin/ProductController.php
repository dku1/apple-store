<?php

namespace App\Http\Controllers\Admin;

use App\Events\ProductCountUpdated;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Modifier;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $products = Product::paginate(15);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        $categories = Category::all();
        $modifiers = Modifier::all();
        return view('admin.products.form', compact('categories', 'modifiers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $data = $this->upload($request);
        Product::create($data);
        session()->flash('success', 'Товар добавлен');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function show(Product $product): Application|Factory|View
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function edit(Product $product): View|Factory|Application
    {
        $categories = Category::all();
        $optionsIds = [];
        foreach ($product->options->toArray() as $option){
            $optionsIds[] = $option['id'];
        }
        return view('admin.products.form', compact(['product','categories', 'optionsIds']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $data = $this->upload($request);
        if($product->count == 0 and $data['count'] > 0){
            event(new ProductCountUpdated($product));
        }
        $product->update($data);

        foreach ($request->option_id as $option_id){
            $product->options()->attach($option_id, ['product_id' => $product->id]);
        }

        session()->flash('success', "$product->name изменён");
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        session()->flash('warning', 'Товар удалён');
        return redirect()->route('products.index');
    }

    private function upload(ProductRequest $request)
    {
        $newDataProduct = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'preview' => $request->preview,
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'count' => $request->count ?? 0,
            'new' => $request->new == 'on' ? 1 : 0,
            'recommend' => $request->recommend == 'on' ? 1 : 0,
            'popular' => $request->popular == 'on' ? 1 : 0,
        ];

        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('products');
            $newDataProduct['img'] = $path;
        }

        return $newDataProduct;
    }

}
