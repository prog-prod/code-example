@extends('admin.layouts.base')
@section('title', 'View Print')

@section('header')
    <div class="d-flex">
        <a href="{{ route('admin.prints.index') }}" class="btn btn-link"><i class="fa fa-arrow-left"></i></a>
        <h1>View Print {{$print->name}}</h1>
    </div>
@stop
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $print->name }}</div>

                    <div class="card-body">
                        <img src="{{Storage::url($print->image)}}" alt="" width="300">
                        <p>Category: {{$print->category->name}}</p>
                        <p>Name UA: {{$print->transUA('name') ?? '-'}}</p>
                        <p>Name EN: {{$print->transEN('name') ?? '-'}}</p>
                        <p>Description UA: {{$print->transUA('description') ?? '-'}}</p>
                        <p>Description EN: {{$print->transEN('description') ?? '-'}}</p>

                        <p>Products:</p>

                        <ul>
                            @forelse($print->products as $product)
                                <li><a href="{{ route('admin.products.show', $product) }}">{{ $product->name }}</a></li>
                            @empty
                                <li>No products assigned</li>
                            @endforelse
                        </ul>

                        <a href="{{ route('admin.prints.edit', $print) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.prints.destroy', $print) }}" method="post"
                              class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
