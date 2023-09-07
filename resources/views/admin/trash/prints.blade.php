@extends('admin.layouts.base')
@section('title', 'Prints Trash')

@section('header')
    <h1><i class="fa fa-trash"></i> Prints Trash</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Prints</h3>
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
                @foreach ($deletedPrints as $print)
                    <tr>
                        <td>
                            {{ $print->key }}
                        </td>
                        <td>{{$print->name_ua}}</td>
                        <td>{{$print->name_en}}</td>
                        <td>{{$print->category->name}}</td>
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
                                <form action="{{ route('admin.trash.prints.restore', $print) }}" method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-primary mr-2">Restore</button>
                                </form>
                                <form action="{{ route('admin.trash.prints.destroy', $print) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this print image?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                            class="fas fa-trash-alt"></i>
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
                {{$deletedPrints->links()}}
            </div>
        </div>
    </div>
@endsection
