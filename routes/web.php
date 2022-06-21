<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PersonalAreaController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CurrencyController as AdminCurrencyController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ModifierController;
use App\Http\Controllers\Admin\OptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [MainController::class, 'index'])->name('index');

Route::get('locale/{locale}', [MainController::class, 'locale'])->name('locale');
Route::post('filters', [MainController::class, 'useFilters'])->name('filters');

Route::get('categories', [MainController::class, 'categories'])->name('categories');
Route::get('product/{product}', [MainController::class, 'product'])->name('product');

Route::prefix('products')->group(function (){
    Route::get('/', [MainController::class, 'products'])->name('products');
    Route::get('{category}', [MainController::class, 'productsFromCategory'])->name('products.category');
});

Route::post('subscribers/add/{product}', [SubscriberController::class, 'add'])->name('subscribers.add');
Route::post('subscribers/destroy/{product}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');

Route::group([
    'prefix' => 'cart',
    'middleware' => 'cart.not.empty',
], function (){
    Route::get('index', [CartController::class, 'index'])->name('cart.index');
    Route::get('remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('coupon', [CartController::class, 'applyCoupon'])->name('cart.apply.coupon');
    Route::get('add/{productId}', [CartController::class, 'add'])
        ->withoutMiddleware(\App\Http\Middleware\CartNotEmpty::class)
        ->name('cart.add');
});

Route::group([
    'prefix' => 'order',
    'middleware' => 'cart.not.empty',
], function (){
    Route::get('create/{totalPrice?}', [OrderController::class, 'create'])->name('order.create');
    Route::post('store', [OrderController::class, 'store'])->name('order.store');
});

Route::group([
    'prefix' => 'user',
    'middleware' => 'auth',
], function (){
    Route::get('orders', [UserController::class, 'orders'])->name('user.orders');
    Route::get('{order}/products', [UserController::class, 'orderProducts'])->name('user.order.products');
});

Route::group([
    'prefix' => 'personal-area',
    'middleware' => 'auth',
], function (){
    Route::get('/', [PersonalAreaController::class, 'index'])->name('personal-area.index');
    Route::get('/edit', [PersonalAreaController::class, 'edit'])->name('personal-area.edit');
    Route::get('subscriptions', [PersonalAreaController::class, 'subscriptions'])->name('personal-area.subscriptions');
    Route::post('/update/{user}', [PersonalAreaController::class, 'update'])->name('personal-area.update');
});

Route::get('currency/{code}', function ($code){
    session()->put('currency', $code);
    return redirect()->back();
})->name('currency');

Route::group([
    'prefix' => 'admin',
    'middleware' => 'is.admin',
], function (){
    Route::resource('products', AdminProductController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('currencies', AdminCurrencyController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('modifiers', ModifierController::class);
    Route::get('options/create/{modifier}', [OptionController::class, 'create'])->name('options.create');
    Route::post('options/store/{modifier}', [OptionController::class, 'store'])->name('options.store');
    Route::post('options/delete/{option}', [OptionController::class, 'delete'])->name('options.delete');

    Route::get('add-modifier', [ModifierController::class, 'addModifierProduct'])->name('add-modifier');
    Route::post('add-modifier/store', [ModifierController::class, 'addModifierProductStore'])->name('add-modifier.store');
    Route::get('modifier/{product}/change_options', [AdminProductController::class, 'changeOptions'])->name('modifier.change.options');

    Route::get('currencies/rates/update', [AdminCurrencyController::class, 'ratesUpdate'])->name('admin.currencies.rates.update');

    Route::prefix('orders')->group(function (){
        Route::get('/', [AdminOrderController::class, 'index'])->name('admin.orders.index');
        Route::get('{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
        Route::get('treatment/{order}', [AdminOrderController::class, 'treatment'])->name('admin.orders.treatment');
    });

    Route::prefix('users')->group(function (){
        Route::get('index', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('orders/{user}', [AdminUserController::class, 'orders'])->name('admin.users.orders');
        Route::get('delete/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    });

});

require __DIR__.'/auth.php';
