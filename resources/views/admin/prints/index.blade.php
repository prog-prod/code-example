@extends('admin.layouts.base')
@section('title', 'Prints')

@section('header')
    <h1>Prints</h1>
@stop
@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Prints</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Print Images</h3>
            <div class="card-tools">
                <a href="{{ route('admin.prints.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Key</th>
                    <th>Name UA</th>
                    <th>Name EN</th>
                    <th>Category</th>
                    <th>Products</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($prints as $print)
                    <tr>
                        <td>
                            <a href="{{route('admin.prints.show', $print)}}">{{ $print->key }}</a>
                        </td>
                        <td>{{$print->transUA('name')}}</td>
                        <td>{{$print->transEN('name')}}</td>
                        <td>
                            <a href="{{route('admin.print-categories.show', $print->category)}}">{{$print->category->name}}</a>
                        </td>
                        <td>
                            @if (count($print->products) > 0)
                                {{ $print->products->count() }}
                            @else
                                No products assigned
                            @endif
                        </td>
                        <td class="text-center">
                            @if($print->image)
                                <img src="{{Storage::url($print->image)}}" alt="" width="50">
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('admin.prints.edit', $print) }}"
                                   class="btn btn-sm btn-primary mr-2"><i class="fas fa-pencil-alt"></i> Edit</a>
                                <form action="{{ route('admin.prints.destroy', $print) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this print image?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{$prints->links()}}
            </div>
        </div>
    </div>
@endsection
