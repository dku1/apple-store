@extends('admin.layouts.master')

@section('title', "Модификатор $modifier->name")

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $modifier->name }}</h3>
                <div class="add">
                    <a href="{{ route('options.create', $modifier) }}" class="btn btn-success" style="width: 100px">Добавить</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered" style="width: 500px; margin-left: 170px">
                    <thead>
                    <tr>
                        <th class="text-center">Значение</th>
                        <th class="text-center">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($modifier->options as $option)
                        <tr>
                            <td class="align-middle text-center">{{ $option->name }}</td>
                            <td style="width: 50px">
                                <form action="{{ route('options.delete', $option) }}" method="post"
                                      class="d-flex justify-content-center">
                                    @csrf
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
    </div>
    </div>
@endsection

