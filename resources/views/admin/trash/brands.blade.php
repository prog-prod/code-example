@extends('admin.layouts.base')
@section('title', 'Brands Trash')

@section('header')
    <h1><i class="fa fa-trash"></i> Brands Trash</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Brands</h3>
            <div class="card-tools">
                <a href="{{ route('admin.brands.create') }}" class="btn btn-primary btn-sm">Create</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Key</th>
                    <th>Name UA</th>
                    <th>Name EN</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($deletedBrands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->key ?? '-'}}</td>
                        <td>{{ $brand->name_ua ?? '-' }}</td>
                        <td>{{ $brand->name_en ?? '-' }}</td>
                        <td>{{ $brand->description ?? '-' }}</td>
                        <td>
                            <form action="{{ route('admin.trash.brands.restore', $brand) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-primary">Restore</button>
                            </form>
                            <form action="{{ route('admin.trash.brands.destroy', $brand->id) }}" method="POST"
                                  style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this brand?')">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$deletedBrands->links()}}
        </div>
    </div>
@endsection
