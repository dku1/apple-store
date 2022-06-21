@extends('layouts.master')

@section('title', 'Товары')

@section('content')
<section class="products">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 d-flex justify-content-center align-items-start">
                <div class="menu">
                    <h3>@lang('main.menu.categories')</h3>
                    <ul>
                        @foreach($categories as $category)
                        <li>
                            <a @if($category->isActive()) class="active" @endif href="{{ route('products.category', $category) }}">{{ $category->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-10 col-sm-12">
                <div class="row">
                    @if(count($products) != 0)
                    @foreach($products as $product)
                        <div class="col-lg-3 col-sm-6">
                            @include('layouts.sub-layouts.card')
                        </div>
                    @endforeach
                    @else
                    <h3>В данной категории товаров нет.</h3>
                    @endif
                </div>
                <div class="d-flex justify-content-center" style="margin-top: 30px">
                    <p>{{ $products->links('pagination::bootstrap-4') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
