@extends('admin.layouts.base')
@section('title', 'Show Product')

@section('header')
    <h1>Colors</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Colors</h3>
            <div class="card-tools">
                <a href="{{ route('admin.colors.create') }}" class="btn btn-primary btn-sm">Add New</a>
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
                    <th>Products</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($colors as $color)
                    <tr>
                        <td>{{ $color->key }}</td>
                        <td>{{ $color->transUA('name') }}</td>
                        <td>{{ $color->transEN('name') }}</td>
                        <td class="d-flex align-items-center">
                            <span class="square-color mr-2"
                                  style="background-color: {{ $color->hex_code }};"></span> {{ $color->hex_code }} ]
                        </td>
                        <td>
                            {{$color->products->count()}}
                        </td>
                        <td>
                            <a href="{{ route('admin.colors.show', $color) }}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{ route('admin.colors.edit', $color) }}" class="btn btn-success btn-sm">Edit</a>
                            <form action="{{ route('admin.colors.destroy', $color) }}" method="POST"
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
