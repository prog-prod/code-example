@extends('admin.layouts.base')
@section('title', 'Pages')

@section('header')
    <h1>Pages</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pages</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.pages.create') }}"
                               class="btn btn-primary">{{ __('Add Page') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Sections Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pages as $page)
                                <tr>
                                    <td><a href="{{route('admin.pages.show', $page)}}">{{ $page->id }}</a></td>
                                    <td>{{ $page->title }}</td>
                                    <td>{{ $page->slug }}</td>
                                    <td>{!!  $page->sections_statuses  !!}</td>
                                    <td>
                                        <a href="{{ route('admin.pages.edit', $page->id) }}"
                                           class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST"
                                              style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this page?')">
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
            </div>
        </div>
    </div>
@endsection
