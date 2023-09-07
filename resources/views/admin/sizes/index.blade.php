@extends('admin.layouts.base')
@section('title', 'Sizes')

@section('header')
    <h1>Sizes</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Sizes</div>
            <div class="card-tools">
                <a href="{{ route('admin.sizes.create') }}" class="btn btn-primary">Add Size</a>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Key</th>
                    <th>Name UA</th>
                    <th>Name EN</th>
                    <th>Category</th>
                    <th>Value</th>
                    <th>Products</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($sizes as $size)
                    <tr>
                        <td>{{ $size->key }}</td>
                        <td>{{ $size->transUA('name') ?? '-' }}</td>
                        <td>{{ $size->transEN('name') ?? '-' }}</td>
                        <td>{{ $size->category?->name ?? '-' }}</td>
                        <td>{{ $size->value }}</td>
                        <td>{{ $size->products->count() }}</td>
                        <td>
                            <a href="{{ route('admin.sizes.show', $size) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.sizes.edit', $size) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.sizes.destroy', $size) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this size?')">Delete
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
