@extends('admin.layouts.master')

@section('title', $product->name)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ '/storage/' . $product->img }}" alt="Изображение недоступно">
            </div>
            <div class="col-md-4">
                <p>Цена: {{ ceil($currency->convert($product->price)) }} {{ $currency->getSymbol() }} </p>
                <p>Продано: {{ $product->sales }}</p>
                <p>Старая цена: {{ ceil($currency->convert($product->old_price)) }} {{ $currency->getSymbol() }}</p>
                <p>Количество: {{ $product->count }}</p>
                <p>Подписчиков: </p>
                <p>Превью: {{ $product->preview }}</p>
                @foreach($product->options as $option)
                     <p>{{ $option->modifier->name }} : {{ $option->name }}</p>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 desc">
                Описание
                <p>{{ $product->description }}</p>
            </div>
        </div>
    </div>
@endsection
