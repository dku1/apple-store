@extends('admin.layouts.master')

@isset($product)
    @section('title', $product->name)
@else
    @section('title', 'Создание товара')
@endisset

@section('content')
    <div class="container">
        <form action="
        @isset($product)
        {{ route('products.update', $product) }}
        @else
        {{ route('products.store') }}
        @endisset
            " class="row g-3" method="post" enctype="multipart/form-data">
            @csrf
            @isset($product)
                @method('PUT')
            @endisset
            <div class="col-md-12">
                @isset($product)
                    <h3>Редактирование {{ $product->name }}</h3>
                @else
                    <h3>Создание товара</h3>
                @endif
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" name="name" id="name"
                       value="{{ $product->name ?? old('name') }}">
            </div>
            <div class="col-md-6">
                <label for="category_id" class="form-label">Категория</label>
                @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <select class="form-control" id="category_id" name="category_id" aria-label=".form-select-sm example">
                    @foreach($categories as $category)
                        <option @if(isset($product) and $product->category->name == $category->name) selected
                                @endif value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 form-floating" style="margin-top: 10px">
                <label for="preview">Превью</label>
                @error('preview')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <textarea class="form-control" name="preview" placeholder="Краткое описание"
                          id="preview">{{ $product->preview ?? old('preview') }}</textarea>
            </div>
            <div class="col-md-12 form-floating" style="margin-top: 10px">
                <label for="floatingTextarea">Описание</label>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <textarea rows="4" style="margin-bottom: 3px" class="form-control" name="description"
                          id="floatingTextarea">{{ $product->description ?? old('description') }}</textarea>
            </div>
            <div class="col-md-12">
                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('img')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6" style="margin-top: 3px">
                <label for="img" class="form-label">Изображение</label>
                <input class="form-control" type="file" value="{{ old('img') }}" name="img" id="formFileDisabled">
            </div>
            <div class="col-md-2" style="margin-top: 3px">
                <label for="count" class="form-label">Количество</label>
                <input type="text" class="form-control" placeholder="*" name="count"
                       value="{{ $product->count ?? old('count') }}" id="count">
            </div>
            <div class="col-md-2" style="margin-top: 3px">
                <label for="old_price" class="form-label">Старая цена (₽)</label>
                <input type="text" class="form-control" placeholder="*"
                       value="{{ $product->old_price ?? old('old_price') }}" name="old_price" id="old_price">
            </div>
            <div class="col-md-2" style="margin-top: 3px">
                <label for="price" class="form-label">Цена (₽)</label>
                <input type="text" class="form-control" value="{{ $product->price ?? old('price') }}" name="price"
                       id="price">
            </div>
            <div class="check col-md-12 d-flex justify-content-between" style="margin-top: 30px">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="new" name="new"
                           @if(isset($product) and $product->isNew()) checked @endif>
                    <label class="form-check-label" for="new">
                        Новинка
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="recommend" id="recommend"
                           @if(isset($product) and $product->isRecommend()) checked @endif>
                    <label class="form-check-label" for="recommend">
                        Рекомендуемый
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="popular" name="popular"
                           @if(isset($product) and $product->isPopular()) checked @endif>
                    <label class="form-check-label" for="popular">
                        Популярный
                    </label>
                </div>
            </div>
            @isset($product->modifiers)
                @foreach($product->modifiers as $modifier)
                    <div class="col-md-3">
                        <label for="option_id" class="form-label">{{ $modifier->name }}</label>
                        <select class="form-control" id="option_id" name="option_id[]" aria-label=".form-select-sm example">
                            @foreach($modifier->options as $option)
                                <option value="{{ $option->id }}" @if(in_array($option->id, $optionsIds)) selected @endif >{{ $option->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            @endisset
            <div class="col-12 text-right" style="margin-top: 40px">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection

