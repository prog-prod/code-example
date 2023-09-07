@extends('admin.layouts.base')
@section('title', 'Categories Trash')

@section('header')
    <h1><i class="fa fa-trash"></i> Categories Trash </h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Categories</h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Key</th>
                    <th>Name UA</th>
                    <th>Name EN</th>
                    <th>Parent Category</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($deletedCategories as $category)
                    <tr>
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->key }}</td>
                        <td>{{ $category->name_ua ?? '-' }}</td>
                        <td>{{ $category->name_en ?? '-' }}</td>
                        <td>{{ $category->parent ? $category->parent->name : '-' }}</td>
                        <td>
                            <form action="{{ route('admin.trash.categories.restore', $category) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-primary">Restore</button>
                            </form>
                            <form action="{{ route('admin.trash.categories.destroy', $category) }}" method="POST"
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
            <div class="mt-2">
                {{$deletedCategories->links()}}
            </div>
        </div>
    </div>
@endsection
