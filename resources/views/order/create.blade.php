@extends('layouts.master')

@section('title', 'Оформление заказа')

@section('content')
<section class="order">
    <form action="{{ route('order.store') }}" method="post">
        @csrf
        <h3>@lang('cart.design_order')</h3>
        <h5>@lang('user.orders.sum'): {{ $totalPrice }} {{ $currency->getSymbol() }}</h5>
        <input type="text" name="sum" value="{{ $totalPrice }}" hidden>
        <label for="email">Email</label>
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input class="form-control" type="email" name="email" id="email" placeholder="Email" value="{{ Auth::check() ? Auth::user()->email : old('email') }}">
        <label for="city">@lang('user.city')</label>
        @error('city')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input class="form-control" type="text" name="city" id="city" placeholder="@lang('user.city')" value="{{ Auth::check() ? Auth::user()->city : old('city') }}">
        <label for="address">@lang('user.address')</label>
        @error('address')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input class="form-control" type="text" name="address" id="address" placeholder="@lang('user.address')" value="{{ Auth::check() ? Auth::user()->address : old('address') }}">
        <label for="index">@lang('user.index')</label>
        @error('index')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input class="form-control" type="text" name="index" id="index" placeholder="@lang('user.index')" value="{{ Auth::check() ? Auth::user()->index : old('index') }}">
        <button type="submit" class="btn btn-success">@lang('user.orders.confirm')</button>
    </form>
</section>
@endsection
