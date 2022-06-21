@extends('admin.layouts.master')

@isset($editCurrency)
    @section('title', $editCurrency->code)
@else
    @section('title', 'Создание валюты')
@endisset



@section('content')
    <div class="container">
        <form action="
        @isset($editCurrency)
        {{ route('currencies.update', $editCurrency) }}
        @else
        {{ route('currencies.store') }}
        @endisset " class="row g-3" method="post">
            @isset($editCurrency)
                @method('PUT')
            @endisset
            @csrf
            <div class="col-md-12">
                @isset($editCurrency)
                    <h3>Редактирование {{ $editCurrency->code }}</h3>
                @else
                        <h3>Создание валюты</h3>
                @endisset
            </div>
            <div class="col-md-1" style="margin-left: 350px ">
                <label for="code" class="form-label">Код</label>
                <input type="text" class="form-control" name="code" id="code"
                       value="{{ $editCurrency->code ?? old('code') }}">
            </div>
            <div class="col-md-1">
                <label for="symbol" class="form-label">Символ</label>
                <input type="text" class="form-control" name="symbol" id="symbol"
                       value="{{ $editCurrency->symbol ??  old('symbol') }}">
            </div>
            <div class="col-md-1">
                <label for="rate" class="form-label">Котировка</label>
                <input type="text" class="form-control" name="rate" id="rate"
                       value="{{ $editCurrency->rate ?? old('rate') }}">
            </div>
            <div class="col-1 text-right" style="margin-top: 31px">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection

