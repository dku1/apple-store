@extends('layouts.master')

@section('title', 'Заказы')

@section('content')
    <section class="user-orders">
        <h3 class="text-center">@lang('user.orders.your_orders')</h3>
        <table class="table table-borderless align-middle">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">@lang('user.city')</th>
                <th scope="col" class="text-center">@lang('user.address')</th>
                <th scope="col" class="text-center">@lang('user.index')</th>
                <th scope="col" class="text-center">@lang('user.orders.sum')</th>
                <th scope="col" class="text-center">@lang('user.orders.date')</th>
                <th scope="col" class="text-center">@lang('user.orders.status')</th>
                <th scope="col" class="text-center">@lang('user.orders.coupon')</th>
                <th scope="col" class="text-center">@lang('user.orders.view')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td class="text-center">{{ $order->email }}</td>
                <td class="text-center">{{ $order->city }}</td>
                <td class="text-center">{{ $order->address }}</td>
                <td class="text-center">{{ $order->index }}</td>
                <td class="text-center">{{ $order->sum }} {{ $order->currency_symbol }}</td>
                <td class="text-center">{{ $order->created_at->format('m-d-y') }}</td>
                <td class="text-center">{{ $order->status == 1 ? __('user.orders.treatment.processed') : __('user.orders.treatment.not_processed') }}</td>
                <td class="text-center">{{ $order->coupon->code ?? '-' }}</td>
                <td class="text-center"><a href="{{ route('user.order.products', $order) }}" class="btn btn-primary">@lang('user.orders.products')</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $orders->links('pagination::bootstrap-4') }}
        </div>
    </section>
@endsection
