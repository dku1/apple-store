<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CouponRequest;
use Carbon\Carbon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $coupons = Coupon::all();
        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $code = \Str::random(8);
        return view('admin.coupon.form', compact('code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CouponRequest $request
     * @return RedirectResponse
     */
    public function store(CouponRequest $request): RedirectResponse
    {
        Coupon::create([
            'code' => $request->code,
            'denomination' => $request->denomination,
            'type' => $request->type,
            'disposable' => $request->disposable == 'on' ? 1: 0,
            'currency_id' => $request->type == 'currency' ? $request->currency_id : null,
            'status' => $request->status == 'on' ? 1 : 0,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);

        session()->flash('success', 'Купон создан');
        return redirect()->route('coupons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Coupon $coupon
     * @return Application|Factory|View
     */
    public function show(Coupon $coupon): View|Factory|Application
    {
        $end_date = Carbon::parse($coupon->end_date)->format('d-m-Y');
        return view('admin.coupon.show', compact('coupon', 'end_date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Coupon $coupon
     * @return Application|Factory|View
     */
    public function edit(Coupon $coupon): Application|Factory|View
    {
        $end_date = Carbon::parse($coupon->end_date)->format('d-m-Y');
        return view('admin.coupon.form', compact('coupon', 'end_date'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CouponRequest $request
     * @param Coupon $coupon
     * @return RedirectResponse
     */
    public function update(CouponRequest $request, Coupon $coupon): RedirectResponse
    {
        $coupon->update([
            'code' => $request->code,
            'denomination' => $request->denomination,
            'type' => $request->type,
            'disposable' => $request->disposable == 'on' ? 1: 0,
            'currency_id' => $request->type == 'currency' ? $request->currency_id : null,
            'status' => $request->status == 'on' ? 1 : 0,
            'end_date' => $request->end_date !== null ? $request->end_date : $coupon->end_date,
            'description' => $request->description,
        ]);

        session()->flash('success', "$coupon->code изменён");
        return redirect()->route('coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Coupon $coupon
     * @return RedirectResponse
     */
    public function destroy(Coupon $coupon): RedirectResponse
    {
        $coupon->delete();
        session()->flash('warning', "$coupon->code удалён");
        return redirect()->route('coupons.index');
    }
}
