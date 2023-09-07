@extends('admin.layouts.base')
@section('title', 'Pages Trash')
@section('plugins.Select2', true)

@section('header')
    <h1><i class="fa fa-trash"></i> Pages Trash</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Pages</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Slug</th>
                            <th>Name UA</th>
                            <th>Name EN</th>
                            <th>Sections</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($deletedPages as $page)
                            <tr>
                                <td>{{ $page->slug  }}</td>
                                <td>{{ $page->name_ua }}</td>
                                <td>{{ $page->name_en }}</td>
                                <td>
                                    <ul>
                                        @foreach($page->sections as $section)
                                            <li>{{$section['key']}}</a></li>
                                        @endforeach
                                    </ul>

                                </td>
                                <td>
                                    <form action="{{ route('admin.trash.pages.restore', $page) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-primary">Restore</button>
                                    </form>
                                    <form
                                        action="{{ route('admin.trash.pages.destroy', $page) }}"
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
                        {{$deletedPages->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
