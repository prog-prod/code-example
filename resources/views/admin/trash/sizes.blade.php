@extends('admin.layouts.base')
@section('title', 'Sizes Trash')

@section('header')
    <h1><i class="fa fa-trash"></i> Sizes Trash</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Sizes</div>
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
                    <th>Category</th>
                    <th>Value</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($deletedSizes as $size)
                    <tr>
                        <td>{{ $size->key }}</td>
                        <td>{{ $size->name_ua ?? '-' }}</td>
                        <td>{{ $size->name_en ?? '-' }}</td>
                        <td>{{ $size->category?->name ?? '-' }}</td>
                        <td>{{ $size->value }}</td>
                        <td>
                            <form action="{{ route('admin.trash.sizes.restore', $size) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-primary">Restore</button>
                            </form>
                            <form action="{{ route('admin.trash.sizes.destroy', $size) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete it forever?')">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{$deletedSizes->links()}}
            </div>
        </div>
    </div>
@endsection
