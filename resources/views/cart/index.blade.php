@extends('layouts.master')

@section('title', 'Корзина')

@section('content')
    <section class="basket">
        <div class="container">
            <div class="row">
                <div class="col-mg-8">
                    <h3>@lang('cart.cart')</h3>
                    <table class="table table-borderless align-middle">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">@lang('subscriptions.image')</th>
                            <th scope="col">@lang('product.product')</th>
                            <th scope="col">@lang('subscriptions.category')</th>
                            <th scope="col">@lang('product.count')</th>
                            <th scope="col">@lang('subscriptions.action')</th>
                            <th scope="col">@lang('product.price')</th>
                            <th scope="col">@lang('cart.cost')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><img src="{{ '/storage/'. $product[0]->img }}" class="card-img-top" alt="..."></td>
                                <td><a href="{{ route('product', $product[0]) }}">{{ $product[0]->name }}</a></td>
                                <td>{{ $product[0]->category->name }}</td>
                                <td>
                                    {{ $product[1] }}
                                </td>
                                <td>
                                    <a href="{{ route('cart.add', $product[0]) }}" class="btn btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('cart.remove', $product[0]) }}" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             fill="currentColor" class="bi bi-cart-dash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1z"/>
                                        </svg>
                                    </a>
                                </td>
                                <td>{{ ceil($currency->convert($product[0]->price)) }} {{ $currency->getSymbol() }}</td>
                                <td>{{ $product[1] * ceil($currency->convert($product[0]->price)) }} {{ $currency->getSymbol() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <p style="margin-top: 50px">@lang('cart.total_cost'): {{ $totalPrice }} {{ $currency->getSymbol() }}</p>
                    <div class="links d-flex justify-content-end">
                        <a href="{{ route('order.create', [ 'totalPrice' => $totalPrice]) }}" class="btn btn-success float-sm-right ">@lang('cart.design_order')</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-mg-2 coupon" style="width: 150px">
            <form action="{{ route('cart.apply.coupon') }}" method="post" style="margin-right: 0">
                @csrf
                <input type="text" name="code" class="form-control" style="width: 120px; margin-left: -20px" placeholder="@lang('cart.coupon')">
                <button class="btn btn-primary" style="width: 120px; margin-left: -20px; margin-top: 10px">@lang('cart.apply')</button>
            </form>
        </div>
    </section>
@endsection
