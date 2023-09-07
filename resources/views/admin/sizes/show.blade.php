@extends('admin.layouts.base')
@section('title', 'Size '.$size->name)

@section('header')
    <h1>View Size {{$size->name}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $size->name }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.sizes.edit', $size) }}" class="btn btn-primary">
                    Edit
                </a>
                <form action="{{ route('admin.sizes.destroy', $size) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this size?')">Delete
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <p><strong>Key:</strong> {{ $size->key }}</p>
            <p><strong>Name UA:</strong> {{ $size->transUA('name') }}</p>
            <p><strong>Name EN:</strong> {{ $size->transEN('name') }}</p>
            <p><strong>Value:</strong> {{ $size->value }}</p>
            <p><strong>Category:</strong>
                @if($size->category)
                    <a href="{{route('admin.categories.show',$size->category)}}">{{ $size->category->name }}</a>
                @else
                    -
                @endif
            </p>
            <hr>
            <h4>Products with this size:</h4>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($size->products as $product)
                    <tr>
                        <td><a href="{{route('admin.products.show',$product)}}">{{ $product->name }}</a></td>
                        <td>{{ $product->quantity }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
