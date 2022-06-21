@extends('layouts.master')

@section('title', 'Корзина')

@section('content')
    <section class="personal-area">
        <div class="container">
            <div class="row">
                <div class="col-mg-8">
                    <h3 class="text-center">@lang('main.menu.personal_area')</h3>
                    <table class="table table-secondary table-hover align-middle text-center">
                        <tbody>
                        <tr>
                            <td>Email</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>@lang('user.city')</td>
                            <td>{{ $user->city }}</td>
                        </tr>
                        <tr>
                            <td>@lang('user.address')</td>
                            <td>{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <td>@lang('user.index')</td>
                            <td>{{ $user->index }}</td>
                        </tr>
                        <tr>
                            <td>@lang('user.date_registry')</td>
                            <td>{{ $user->created_at->format('m-d-y') }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <p class="text-center">
                        <a style="width: 130px" class="btn btn-secondary" aria-current="page" href="{{ route('user.orders') }}">@lang('user.my_orders')</a>
                    </p>
                    <p class="text-center">
                        <a style="width: 130px" class="btn btn-secondary" aria-current="page" href="{{ route('personal-area.subscriptions') }}">@lang('user.subscriptions')</a>
                    </p>
                    <p class="text-center">
                        <a style="width: 130px" class="btn btn-secondary" aria-current="page" href="{{ route('personal-area.edit') }}">@lang('user.edit')</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

