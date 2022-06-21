@extends('admin.layouts.master')

@section('title', $coupon->code)

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Купон {{ $coupon->code }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Код</th>
                        <th class="text-center">Номинал</th>
                        <th class="text-center">Число использований</th>
                        <th class="text-center">Статус</th>
                        <th class="text-center">Создан</th>
                        <th class="text-center">Действует до</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center">{{ $coupon->id }}</td>
                        <td class="text-center">{{ $coupon->code }}</td>
                        <td class="text-center">{{ $coupon->denomination }} {{ $coupon->type == 'percentage' ? '%' : $coupon->currency->symbol  }}</td>
                        <td class="text-center">{{ $coupon->isDisposable() ? 'Разовый' : 'Неограничено' }}</td>
                        <td class="text-center">{{ $coupon->isActive() ? 'Активен' : 'Не активен' }}</td>
                        <td class="text-center">{{ $coupon->created_at->format('d-m-Y') }}</td>
                        <td class="text-center">{{ $end_date }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @if($coupon->issetDescription())
            <div class="row">
                <div class="col-md-6" style="margin-left: 5px">
                    {{$coupon->description}}
                </div>
            </div>
        @endif
@endsection
