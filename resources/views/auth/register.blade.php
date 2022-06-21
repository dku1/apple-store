@extends('layouts.master')

@section('title', 'Регистрация')

@section('content')
    <section class="registry">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <h3>Регистрация</h3>
            <form class="row g-3">
                <div class="col-md-6">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="inputEmail4" class="form-label">Эл. адрес</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="inputEmail4">
                </div>
                <div class="col-md-6">
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="inputPassword4" class="form-label">Пароль</label>
                    <input type="password" class="form-control" name="password" id="inputPassword4">
                </div>
                <div class="col-md-6">
                    @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="inputPassword_confirm" class="form-label">Пароль ещё раз</label>
                    <input type="password" class="form-control" name="password_confirmation" id="inputPassword_confirm">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Адрес</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address') }}" id="inputAddress" placeholder="Социалистический проспект 68">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Город</label>
                    <input type="text" class="form-control" name="city" value="{{ old('city') }}" id="inputCity" placeholder="Москва">
                </div>
                <div class="col-md-2">
                    @error('index')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="index" class="form-label">Индекс</label>
                    <input type="text" class="form-control" name="index" value="{{ old('index') }}" id="index" placeholder="656049">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Зарегистрироваться</button>
                </div>
            </form>
        </form>
    </section>
@endsection
