@extends('admin.layouts.master')

@section('title', 'Модификаторы')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Модификаторы</h3>
                <div class="add">
                    <a href="{{ route('modifiers.create') }}" class="btn btn-success" style="width: 100px">Добавить</a>
                </div>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered" style="width: 1000px; margin: auto">
                    <thead>
                    <tr>
                        <th class="text-center">Модификатор</th>
                        <th class="text-center">Количество опций</th>
                        <th class="text-center">Количество товаров</th>
                        <th class="text-center" style="width: 200px">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($modifiers as $modifier)
                        <tr>
                            <td class="align-middle text-center"><a
                                    href="{{ route('modifiers.show', $modifier) }}">{{ $modifier->name }}</a></td>
                            <td class="align-middle text-center">{{ $modifier->options->count() }}</td>
                            <td class="align-middle text-center">{{ $modifier->products->count() }}</td>
                            <td>
                                <form action="{{ route('modifiers.destroy', $modifier) }}" method="post"
                                      class="d-flex justify-content-between">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('modifiers.show', $modifier) }}" class="btn btn-primary"
                                       style="margin-right: 5px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                             fill="currentColor"
                                             class="bi bi-eye" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('modifiers.edit', $modifier) }}" class="btn btn-warning"
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
                    </tbody>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection



