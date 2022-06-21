@extends('admin.layouts.master')

@isset($modifier)
    @section('title', $modifier->name)
@else
    @section('title', 'Создание купона')
@endisset

@section('content')
    <div class="container">
        <form class="row g-3" action="
        @isset($modifier)
        {{ route('modifiers.update', $modifier) }}
        @else
        {{ route('modifiers.store') }}
        @endisset" method="post">
            @isset($modifier)
                @method('PUT')
            @endisset
            @csrf
            <div class="col-md-10" style="margin-left: 7px;margin-top: 10px">
                @isset($modifier)
                    <h4>{{$modifier->name}}</h4>
                @else
                    <h4>Создание модификатора</h4>
                @endisset
            </div>
            <div class="col-md-10">
                <div class="col-md-4">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-10 d-flex">
                <div class="col-md-4">
                    <label for="name" class="form-label">Название</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Цвет"
                           value="{{ isset($modifier) ? $modifier->name : old('name') }}">
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

