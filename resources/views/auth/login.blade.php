@extends('layouts.master')

@section('title', 'Авторизация')

@section('content')
<section class="auth">
    <form action="{{ route('login') }}" method="post">
        @csrf
        <h3>Авторизация</h3>
        <label for="email">Введите ваш email</label>
        <input class="form-control" type="email" name="email" id="email" placeholder="email">
        <label for="password" class="pass">Введите ваш пароль</label>
        <input class="form-control" type="password" name="password" value="" id="password" placeholder="пароль">
        <button type="submit" class="btn btn-success">Вход</button>
    </form>
</section>
@endsection
