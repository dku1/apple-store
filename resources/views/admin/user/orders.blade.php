@extends('admin.layouts.master')

@section('title', 'Заказы')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Заказы</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Сумма</th>
                        <th class="text-center">Дата заказа</th>
                        <th class="text-center">Статус</th>
                        <th class="text-center">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="align-middle text-center">{{ $order->id }}</td>
                            <td class="align-middle text-center">{{ $order->email }}</td>
                            <td class="align-middle text-center">{{ $order->sum }} {{ $order->currency_symbol }}</td>
                            <td class="align-middle text-center">{{ $order->created_at->format('Y-m-d') }}</td>
                            <td class="align-middle text-center">{{ $order->status == 1 ? 'Обработан' : 'Не обработан' }}</td>
                            <td class="align-middle text-center">
                                <a href="{{ route('admin.orders.show', $order) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.card -->
@endsection


