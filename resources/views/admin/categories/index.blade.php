@extends('admin.layouts.base')
@section('title', 'Categories')

@section('header')
    <div class="d-flex">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-link"><i class="fa fa-arrow-left"></i></a>
        <h1>Categories</h1>
    </div>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Categories</h3>
            <div class="card-tools">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create Category</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Key</th>
                    <th>Name UA</th>
                    <th>Name EN</th>
                    <th>Parent Category</th>
                    <th>Products</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td><a href="{{route('admin.categories.show', $category)}}">{{ $category->key }}</a></td>
                        <td>{{ $category->transUA('name') ?? '-' }}</td>
                        <td>{{ $category->transEN('name') ?? '-' }}</td>
                        <td>{{ $category->parent ? $category->parent->name : '-' }}</td>
                        <td>{{ $category->products->count() }}</td>
                        <td>@if($category->image)
                                <img
                                    src="{{ is_url($category->image) ? $category->image : Storage::url($category->image) }}"
                                    alt="" width="50px">
                            @else
                                -
                            @endif</td>
                        <td>
                            <a href="{{ route('admin.categories.show', $category) }}"
                               class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                  style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this category?')">
                                    Delete
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
