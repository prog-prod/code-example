@extends('admin.layouts.base')
@section('title', 'Colors Trash')

@section('header')
    <h1><i class="fa fa-trash"></i> Colors Trash</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Colors</h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Key</th>
                    <th>Name UA</th>
                    <th>Name EN</th>
                    <th>Hex Code</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($deletedColors as $color)
                    <tr>
                        <td>{{ $color->key }}</td>
                        <td>{{ $color->name_ua }}</td>
                        <td>{{ $color->name_en }}</td>
                        <td class="d-flex align-items-center">
                        <span class="square-color mr-2"
                              style="background-color: {{ $color->hex_code }};"></span> {{ $color->hex_code }} </td>
                        <td>
                            <form action="{{ route('admin.trash.colors.restore', $color) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-primary">Restore</button>
                            </form>
                            <form action="{{ route('admin.trash.colors.destroy', $color) }}" method="POST"
                                  style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this color?')">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-2">
                {{$deletedColors->links()}}
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .square-color {
            display: inline-block;
            width: 30px;
            height: 30px;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
        }
    </style>

@endsection
