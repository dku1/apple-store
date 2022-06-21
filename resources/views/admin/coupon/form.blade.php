@extends('admin.layouts.master')

@isset($coupon)
    @section('title', $coupon->code)
@else
    @section('title', 'Создание купона')
@endisset

@section('content')
    <div class="container">
        <form class="row g-3" action="
        @isset($coupon)
        {{ route('coupons.update', $coupon) }}
        @else
        {{ route('coupons.store') }}
        @endisset" method="post">
            @isset($coupon)
                @method('PUT')
            @endisset
            @csrf
            <div class="col-md-10" style="margin-left: 7px;margin-top: 10px">
                @isset($coupon)
                    <h4>{{$coupon->code}}</h4>
                @else
                    <h4>Создание купона</h4>
                @endisset
            </div>
            <div class="col-md-10">
                <div class="col-md-4">
                    @error('code')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('denomination')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-10 d-flex">
                <div class="col-md-2">
                    <label for="code" class="form-label">Код</label>
                    <input type="text" class="form-control" id="code" name="code"
                           value="{{ isset($coupon) ? $coupon->code : $code }}">
                </div>
                <div class="col-md-2">
                    <label for="denomination" class="form-label">Номинал</label>
                    <input type="text" class="form-control" id="denomination" name="denomination"
                           value="{{ isset($coupon) ? $coupon->denomination : old('denomination') }}">
                </div>
            </div>
            <div class="col-md-10 d-flex" style="margin-top: 15px">
                @error('type')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="col-md-2">
                    <select class="form-control" name="type" aria-label=".form-select-sm example">
                        @foreach(['percentage' => 'Процентный', 'currency' => 'Валютный'] as $type => $value)
                            <option value="{{ $type }}"
                                    @if(isset($coupon) and  $coupon->type == $type) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="currency_id" aria-label=".form-select-sm example">
                        @foreach($currencies as $currency)
                            <option value="{{ $currency->id }}"
                                    @if(isset($coupon) and  $coupon->type == 'currency' and $coupon->currency->code == $currency->code) selected @endif>{{ $currency->symbol }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12 d-flex" style="margin-left: 8px; margin-top: 15px">
                <div class="form-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="disposable" id="disposable" @if(isset($coupon) and $coupon->isDisposable()) checked @endif>
                    <label class="form-check-label" for="disposable">Одноразовый</label>
                </div>
                <div class="form-check col-md-2" style="margin-left: 25px;">
                    <input class="form-check-input" type="checkbox" name="status" id="status" @if(isset($coupon) and $coupon->isActive()) checked @elseif(!isset($coupon)) checked @endif >
                    <label class="form-check-label" for="status">Активен</label>
                </div>
            </div>
            <div class="col-md-10" style="margin-top: 15px">
                @error('end_date')
                <div class="col-md-4">
                    <div class="alert alert-danger">{{ $message }}</div>
                </div>
                @enderror
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="end_date">Действует до: {{ $end_date ?? '' }}</label>
                        <input type="date" class="form-control" name="end_date" id="end_date">
                    </div>
                </div>
            </div>
            <div class="col-md-10" style="margin-top: 10px">
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="description">Описание:</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-10" style="margin-top: 15px">
                <div class="col-md-4 text-right">
                    <button class="btn btn-success">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
@endsection

