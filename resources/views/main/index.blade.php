@extends('layouts.master')

@section('title', 'Apple Store')

@section('content')
<section class="main-content">
    <div class="container" style="min-height: 635px">
        <h3 class="text-center">@lang('main.menu.all_products')</h3>
        <div class="row">
            @foreach($products as $product)
                <div class="col-lg-4 col-sm-6">
                   @include('layouts.sub-layouts.card')
                </div>
            @endforeach
        </div>
        @include('layouts.sub-layouts.filter')
    </div>
</section>
@if(!isset($service))
<div class="d-flex justify-content-center" style="margin-top: 30px">
    <p>{{ $products->links('pagination::bootstrap-4') }}</p>
</div>
@endisset
@endsection
