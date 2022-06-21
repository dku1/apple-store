@extends('admin.layouts.master')

@isset($category)
    @section('title', $category->name)
@else
    @section('title', 'Создание категории')
@endisset

@section('content')
    <div class="container">
        <form action="
        @isset($category)
        {{ route('categories.update', $category) }}
        @else
        {{ route('categories.store') }}
        @endisset
        " class="row g-3" method="post" enctype="multipart/form-data">
            @csrf
            @isset($category)
                @method('PUT')
            @endisset
            <div class="col-md-12">
                @isset($category)
                    <h3>Редактирование {{ $category->name }}</h3>
                @else
                    <h3>Создание категории</h3>
                @endif
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" name="name" id="name"
                       value="{{ $category->name ?? old('name') }}">
            </div>
            <div class="col-md-12 form-floating" style="margin-top: 10px">
                <label for="floatingTextarea">Описание</label>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <textarea rows="4" style="margin-bottom: 3px" class="form-control" name="description"
                          id="floatingTextarea">{{ $category->description ?? old('description') }}</textarea>
            </div>
            <div class="col-md-12">
                @error('img')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12" style="margin-top: 3px">
                <label for="img" class="form-label">Изображение</label>
                <input class="form-control" type="file" value="{{ old('img') }}" name="img" id="formFileDisabled">
            </div>
            <div class="col-12 text-right" style="margin-top: 10px">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection

