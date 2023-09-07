@extends('admin.layouts.base')
@section('title', 'Print Categories')
@section('plugins.Select2', true)

@section('header')
    <h1>Print Categories</h1>
@stop
@php
    $config_select2 = [
        "allowClear" => true
    ];
@endphp
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Edit Print Category</h4>
                        <a href="{{ route('admin.print-categories.create') }}" class="btn btn-primary"><i
                                class="fas fa-plus"></i> Create Print
                            Category</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Key</th>
                            <th>Name UA</th>
                            <th>Name EN</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Parent</th>
                            <th>Prints</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($printCategories as $printCategory)
                            <tr>
                                <td>
                                    <a href="{{route('admin.print-categories.show', $printCategory)}}">{{ $printCategory->key }}</a>
                                </td>
                                <td>{{ $printCategory->transUA('name') ?? '-' }}</td>
                                <td>{{ $printCategory->transEN('name') ?? '-' }}</td>
                                <td><img src="{{ Storage::url($printCategory->image) }}" alt="" width="50"></td>
                                <td>{{ $printCategory->trans('description') ?? '-' }}</td>
                                <td>
                                    @if($printCategory->parent)
                                        <a href="{{route('admin.print-categories.show', $printCategory)}}">{{$printCategory->parent->name}}</a>
                                    @endif
                                </td>
                                <td> {{$printCategory->prints->count()}} </td>
                                <td>
                                    <a href="{{ route('admin.print-categories.edit', $printCategory) }}"
                                       class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.print-categories.destroy', $printCategory) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
