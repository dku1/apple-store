<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $categories = Category::paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        if ($request->hasFile('img')){
            $path =  $request->file('img')->store('categories');
            $data['img'] = $path;
        }
        session()->flash('success', "Категория добавлена");
        Category::create($data);
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function show(Category $category): View|Factory|Application
    {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category): View|Factory|Application
    {
        return view('admin.category.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        if ($request->hasFile('img')){
            $path =  $request->file('img')->store('categories');
            $data['img'] = $path;
        }
        $category->update($data);
        session()->flash('success', "$category->name изменена");
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        if($category->products->count() !== 0){
            session()->flash('warning', 'В категории есть товары');
            return redirect()->route('categories.index');
        }
        $category->delete();
        session()->flash('warning', 'Категория удалёна');
        return redirect()->route('categories.index');
    }
}
