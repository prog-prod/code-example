@extends('admin.layouts.base')
@section('title', 'Menu '.$menu->name)

@section('header')
    <div class="d-flex">
        <a href="{{ route('admin.menus.index') }}" class="btn btn-link"><i class="fa fa-arrow-left"></i></a>
        <h1>Menu {{$menu->name}}</h1>
    </div>
@stop
@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Menu Details</h1>
        <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-warning">Edit</a>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h2 class="card-title">Menu Items:</h2>
            <h3 class="card-tools">
                <a href="{{ route('admin.menu_items.create', ['menu_id' => $menu->id]) }}" class="btn btn-primary">Add
                    Item</a></h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Key</th>
                    <th>Name UA</th>
                    <th>Name EN</th>
                    <th>Image</th>
                    <th>Parent</th>
                    <th>Mega</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($menu->items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->key }}</td>
                        <td>{{ $item->transUA('name') ?? '-'}}</td>
                        <td>{{ $item->transEN('name') ?? '-'}}</td>
                        <td>
                            @if ($item->image)
                                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" width="50">
                            @else
                                -
                            @endif
                        </td>
                        <td>{{$item->parent?->name ?? '-'}}</td>
                        <td class="{{$item->mega ? 'text-success' : 'text-danger'}}">
                            <b>{{$item->mega ? '+' : '-'}}</b>
                        </td>
                        <td>{{ $item->link }}</td>

                        <td>
                            <a href="{{ route('admin.menu_items.edit', ['menu_item' => $item, 'menu_id' => $menu->id]) }}"
                               class="btn btn-warning btn-sm">Edit</a>
                            <form
                                action="{{ route('admin.menu_items.destroy', ['menu_item' => $item, 'menu_id' => $menu->id]) }}"
                                method="POST"
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
