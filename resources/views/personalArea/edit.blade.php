@extends('layouts.master')

@section('title', 'Редактирование профиля')

@section('content')
    <section class="personal-area-edit">
        <form action="{{ route('personal-area.update', $user) }}" method="post">
            @csrf
            <h3>@lang('main.menu.edit_profile')</h3>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="email">Email</label>
            <input class="form-control" type="email" value="{{ $user->email }}" name="email" id="email" placeholder="email">
            <label for="city">@lang('user.city')</label>
            <input class="form-control" type="text" value="{{ $user->city }}" name="city" id="city" placeholder="@lang('user.city')">
            <label for="address">@lang('user.address')</label>
            <input class="form-control" type="text" value="{{ $user->address }}" name="address" id="address" placeholder="@lang('user.address')">
            @error('index')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="index">@lang('user.index')</label>
            <input class="form-control" type="text" value="{{ $user->index }}" name="index" id="index" placeholder="@lang('user.index')">
            <button type="submit" class="btn btn-success">@lang('main.menu.save')</button>
        </form>
    </section>
@endsection

