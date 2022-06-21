@extends('admin.layouts.master')

@section('title', "Заказ $order->id")

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Заказ {{ $order->id }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Город</th>
                        <th class="text-center">Адрес</th>
                        <th class="text-center">Индекс</th>
                        @isset($order->coupon)
                            <th class="text-center">Купон</th>
                        @endisset
                        <th class="text-center">Пользователь</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="align-middle text-center">{{ $order->id }}</td>
                        <td class="align-middle text-center">{{ $order->email }}</td>
                        <td class="align-middle text-center">{{ $order->city }}</td>
                        <td class="align-middle text-center">{{ $order->address }}</td>
                        <td class="align-middle text-center">{{ $order->index }}</td>
                        @isset($order->coupon)
                            <td class="align-middle text-center"><a href="{{ route('coupons.show', $order->coupon ) }}">{{ $order->coupon->code }}</a></td>
                        @endisset
                        <td class="align-middle text-center">{{ $order->user->email ?? 'Гость' }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <a href="{{ route('admin.orders.treatment', $order) }}" class="btn btn-success order @if($order->status == 1) d-none @endif">Обработать</a>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Товары</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Изображение</th>
                        <th class="text-center">Товар</th>
                        <th class="text-center">Цена</th>
                        <th class="text-center">Количество</th>
                        <th class="text-center">Сумма</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->products()->paginate(5) as $product)
                        <tr>
                            <td class="align-middle text-center" style="width: 50px">
                                {{ $loop->iteration }}
                            </td>
                            <td class="align-middle text-center" style="width: 100px">
                                <img src=" {{ '/storage/'.$product->img }}" alt="Изображение недоступно">
                            </td>
                            <td class="align-middle text-center" style="width: 400px"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></td>
                            <td class="align-middle text-center">
                                {{ ceil($currencyOrder->convert($product->price, true)) }} {{ $currencyOrder->symbol }}
                            </td>
                            <td class="align-middle text-center" style="width: 150px">
                                {{ $quantity[$product->id] }}
                            </td>
                            <td class="align-middle text-center" style="width: 150px">
                                {{  ceil($currencyOrder->convert($product->price, true)) * $quantity[$product->id] }} {{ $currencyOrder->symbol }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <p>{{ $order->products()->paginate(5)->links('pagination::bootstrap-4') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

