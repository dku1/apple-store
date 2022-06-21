@extends('layouts.master')

@section('title', 'Подписки')

@section('content')
    <section class="basket">
        <div class="container">
            <div class="row">
                <div class="col-mg-8">
                    <h3>@lang('subscriptions.active_subscriptions')</h3>
                    <table class="table table-borderless align-middle">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">@lang('subscriptions.image')</th>
                            <th scope="col">@lang('subscriptions.product')</th>
                            <th scope="col">@lang('subscriptions.category')</th>
                            <th scope="col">@lang('subscriptions.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><img src="{{ '/storage/'. $product->img }}" class="card-img-top" alt="..."></td>
                                <td><a href="{{ route('product', $product) }}">{{ $product->name }}</a></td>
                                <td>{{ $product->category->name }}</td>
                                <td>
                                    <form action="{{ route('subscribers.destroy', $product) }}" class="row g-3"
                                          method="POST">
                                        @csrf
                                        <input type="email" value="{{ Auth::user()->email }}" name="email" hidden>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-danger mb-3">
                                                @lang('subscriptions.unsubscribe')
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
