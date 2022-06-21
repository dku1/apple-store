@extends('admin.layouts.master')

@section('title', $category->name)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ '/storage/' . $category->img }}" alt="Изображение недоступно">
            </div>
            <div class="col-md-4">
                <p>Количество товаров: {{ $category->products->count() }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 desc">
                Описание
            <p>{{ $category->description }}</p>
            </div>
        </div>
    </div>
@endsection
