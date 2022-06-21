@extends('admin.layouts.master')

@isset($option)
    @section('title', $option->name)
@else
    @section('title', "Создание опии для $modifier->name")
@endisset

@section('content')
    <div class="container">
        <form class="row g-3" action="{{ route('options.store', $modifier) }}" method="post">
            @csrf
            <div class="col-md-10" style="margin-left: 7px;margin-top: 10px">
                <h4>Добавление опции для {{$modifier->name}}</h4>
            </div>
            <div class="col-md-10 d-flex">
                <div class="col-md-4">
                    <label for="name" class="form-label">Опция</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{ isset($option) ? $option->name : old('name') }}">
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

