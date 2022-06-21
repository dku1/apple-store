@extends('layouts.master')

@section('title', 'Товары в заказе')

@section('content')
    <section class="order-products">
        <h3 class="text-center">@lang('user.orders.items_order') #{{ $order->id }}</h3>
        <table class="table table-borderless align-middle">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('subscriptions.image')</th>
                <th scope="col">@lang('product.product')</th>
                <th scope="col">@lang('product.price')</th>
                <th scope="col">@lang('product.count')</th>
                <th scope="col">@lang('user.orders.sum')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->products()->paginate(5) as $product)
               <tr>
                   <td>
                       {{ $loop->iteration }}
                   </td>
                   <td>
                       <img src=" {{ '/storage/'.$product->img }}" alt="Изображение недоступно">
                   </td>
                   <td>
                       <a href="{{ route('product', $product) }}">{{ $product->name }}</a>
                   </td>
                   <td>
                       {{ ceil($currencyOrder->convert($product->price, true)) }} {{ $currencyOrder->symbol }}
                   </td>
                   <td>
                       {{ $quantity[$product->id] }}
                   </td>
                   <td>
                       {{  ceil($currencyOrder->convert($product->price, true)) * $quantity[$product->id] }} {{ $currencyOrder->symbol }}
                   </td>
               </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <p>{{ $order->products()->paginate(5)->links('pagination::bootstrap-4') }}</p>
        </div>
        <p class="text-center"><a href="{{ route('user.orders') }}" class="btn btn-primary text-center">@lang('product.back_to_orders')</a></p>
    </section>
@endsection
