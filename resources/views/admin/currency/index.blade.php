@extends('admin.layouts.master')

@section('title', 'Валюты')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Валюты</h3>
                <div class="add">
                    <a href="{{ route('currencies.create') }}" class="btn btn-success" style="width: 100px">Добавить</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered" style="width: 1000px; margin: auto">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Код</th>
                        <th class="text-center">Символ</th>
                        <th class="text-center">Курс</th>
                        <th class="text-center">Последнее обновление</th>
                        <th class="text-center">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($currencies as $currency)
                        <tr>
                            <td class="align-middle text-center">{{ $currency->id }}</td>
                            <td class="align-middle text-center">{{ $currency->code }}</td>
                            <td class="align-middle text-center">{{ $currency->symbol }}</td>
                            <td class="align-middle text-center">{{ $currency->rate }}</td>
                            <td class="align-middle text-center">{{ $currency->updated_at ? $currency->updated_at->format('d/m/Y') : '-' }}</td>
                            <td>
                                <form action="{{ route('currencies.destroy', $currency) }}" method="POST" class="text-center">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('currencies.edit', $currency) }}" class="btn btn-warning"
                                       style="margin-right: 5px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                             fill="currentColor"
                                             class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path
                                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </a>
                                    <button class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                             fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path
                                                d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="rate-update text-right">
            <a href="{{ route('admin.currencies.rates.update') }}" class="btn btn-success" style="width: 200px">Обновить котировки</a>
        </div>
    </div>
    <!-- /.card -->
@endsection


