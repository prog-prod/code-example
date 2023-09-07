@extends('admin.layouts.base')
@section('title', 'Layouts Trash')

@section('header')
    <h1><i class="fa fa-trash"></i> Layouts Trash</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Layouts</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Key</th>
                            <th>Name UA</th>
                            <th>Name EN</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($deletedLayouts as $layout)
                            <tr>
                                <td>{{ $layout->key }}</td>
                                <td>{{ $layout->name_ua }}</td>
                                <td>{{ $layout->name_en }}</td>
                                <td>
                                    <ul>
                                        @foreach($layout->pages as $page)
                                            <li><a href="{{route('admin.pages.show',$page)}}">{{$page->name}}</a></li>
                                        @endforeach
                                    </ul>

                                </td>
                                <td>
                                    <form action="{{ route('admin.trash.layouts.restore', $layout) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-primary">Restore</button>
                                    </form>
                                    <form
                                        action="{{ route('admin.trash.layouts.destroy', $layout) }}"
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
                        {{$deletedLayouts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
