@extends('admin.layouts.base')
@section('title', 'Brands')

@section('header')
    <h1>Brands</h1>
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
                    <th>Products</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td><a href="{{route('admin.brands.show', $brand)}}">{{ $brand->key }}</a></td>
                        <td>{{ $brand->transUA('name') ?? '-' }}</td>
                        <td>{{ $brand->transEN('name') ?? '-' }}</td>
                        <td>{{ $brand->products->count() }}</td>
                        <td>
                            <a href="{{ route('admin.brands.show', $brand->id) }}"
                               class="btn btn-primary btn-sm">View</a>
                            <a href="{{ route('admin.brands.edit', $brand->id) }}"
                               class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST"
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
        </div>
    </div>
@endsection
