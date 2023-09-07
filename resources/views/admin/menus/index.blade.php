@extends('admin.layouts.base')
@section('title', 'Menus')

@section('header')
    <h1>Menus</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Menus</div>
            <div class="card-tools">
                <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">Create Menu</a>
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($menus as $menu)
                    <tr>
                        <td>{{ $menu->id }}</td>
                        <td>{{ $menu->name }}</td>
                        <td>
                            @if ($menu->image)
                                <img src="{{ Storage::url($menu->image) }}" alt="{{ $menu->name }}" width="50">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.menus.show', $menu) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.menus.destroy', ['menu' => $menu]) }}" method="POST"
                                  style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">
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
