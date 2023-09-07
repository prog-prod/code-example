@extends('admin.layouts.base')
@section('title', 'View brand')

@section('header')
    <h1>View brand</h1>
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $brand->name }}</h3>
                    </div>
                    <div class="card-body">
                        <p>Key: {{ $brand->key }}</p>
                        <p>Name UA: {{ $brand->transUA('name') ?? '-'}}</p>
                        <p>Name EN: {{  $brand->transEN('name') ?? '-' }}</p>
                        <p>Description UA: {{ $brand->transUA('description')  ?? '-'}}</p>
                        <p>Description EN: {{ $brand->transEN('description')  ?? '-'}}</p>
                        <hr>
                        <h4>Products</h4>
                        <ul>
                            @forelse($brand->products as $product)
                                <li><a href="{{route('admin.products.show',$product)}}">{{ $product->name }}</a></li>
                            @empty
                                <p>No products found for this brand</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
