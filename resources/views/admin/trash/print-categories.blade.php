@extends('admin.layouts.base')
@section('title', 'Print Categories Trash')
@section('plugins.Select2', true)

@section('header')
    <h1><i class="fa fa-trash"></i> Print Categories Trash</h1>
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
                <div class="card-header">Print Categories</div>
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
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($deletedPrintCategories as $printCategory)
                            <tr>
                                <td>{{ $printCategory->key }}</td>
                                <td>{{ $printCategory->name_ua }}</td>
                                <td>{{ $printCategory->name_en }}</td>
                                <td><img src="{{ Storage::url($printCategory->image) }}" alt="" width="50"></td>
                                <td>{{ $printCategory->description }}</td>
                                <td>
                                    @if($printCategory->parent)
                                        <a href="{{route('admin.print-categories.show', $printCategory)}}">{{$printCategory->parent->name}}</a>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.trash.print-categories.restore', $printCategory) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-primary">Restore</button>
                                    </form>
                                    <form
                                        action="{{ route('admin.trash.print-categories.destroy', $printCategory) }}"
                                        method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete it forever?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{$deletedPrintCategories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
