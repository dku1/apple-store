@extends('admin.layouts.master')

@section('title', 'Пользователи')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Пользователи</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Город</th>
                        <th class="text-center">Адрес</th>
                        <th class="text-center">Индекс</th>
                        <th class="text-center">Заказы</th>
                        <th class="text-center">Дата регистрации</th>
                        <th class="text-center" style="width: 250px">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="align-middle text-center">{{ $user->id }}</td>
                            <td class="align-middle text-center">{{ $user->email }}</td>
                            <td class="align-middle text-center">{{ $user->city ?? 'Не указан' }}</td>
                            <td class="align-middle text-center">{{ $user->address ?? 'Не указан' }}</td>
                            <td class="align-middle text-center">{{ $user->index ?? 'Не указан' }}</td>
                            <td class="align-middle text-center">
                                <a href="{{ route('admin.users.orders', $user) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-three-dots" viewBox="0 0 16 16">
                                        <path
                                            d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                    </svg>
                                </a>
                            </td>
                            <td class="align-middle text-center">{{ $user->created_at->format('Y-m-d') }}</td>
                            <td class="align-middle text-center" >
                                <a href="{{ route('admin.users.destroy', $user) }}" class="btn btn-danger">Удалить</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="d-flex justify-content-center paginate">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <!-- /.card -->
@endsection

