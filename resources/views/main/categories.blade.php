@extends('layouts.master')

@section('title', 'Категории')

@section('content')
    <section class="categories">
        <div class="container">
            <div class="row d-flex flex-direction-column justify-content-center">
                @foreach($categories as $category)
                    <div class="col-lg-7 text-center">
                        <img src="{{ '/storage/'.$category->img }}" alt="Изображение недоступно">
                        <h3><a href="{{ route('products.category', $category) }}">{{ $category->name }}</a></h3>
                        <p>
                            {{ $category->description }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center" style="margin-top: 30px">
        <p>{{ $categories->links('pagination::bootstrap-4') }}</p>
    </div>
@endsection
