@extends('admin.layouts.master')

@section('title', 'Присвоение модификаторов')

@section('content')
    <div class="container">
        <form class="row g-3" action="{{ route('add-modifier.store') }}" method="post">
            @csrf
            <div class="col-md-10" style="margin-left: 7px;margin-top: 10px">
                <h4>Присвоение модификаторов</h4>
            </div>
            <div class="col-md-10">
                <label for="product_id" class="form-label">Выберите товар</label>
                <select class="form-control" id="product_id" name="product_id" aria-label=".form-select-sm example">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-10">
                <label for="modifiers_id" class="form-label">Выберите модификаторы</label>
                <select class="form-control" id="modifiers_id" name="modifiers_id[]" aria-label=".form-select-sm example" multiple>
                    @foreach($modifiers as $modifier)
                        <option value="{{ $modifier->id }}">{{ $modifier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-10" style="margin-top: 15px">
                <div class="col-md-4">
                    <button class="btn btn-success">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
@endsection


