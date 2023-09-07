@extends('admin.layouts.base')
@section('title', 'Sale '.$sale->name)

@section('header')
    <h1>View Sale {{$sale->name}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $sale->name }}</h3>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Name UA:</dt>
                <dd class="col-sm-9">{{ $sale->transUA('name') ?? '-'}}</dd>

                <dt class="col-sm-3">Name EN:</dt>
                <dd class="col-sm-9">{{ $sale->transEN('name') ?? '-'}}</dd>

                <dt class="col-sm-3">Quantity:</dt>
                <dd class="col-sm-9">{{ $sale->quantity }}</dd>

                <dt class="col-sm-3">Percent:</dt>
                <dd class="col-sm-9">{{ $sale->percent }}</dd>

                <dt class="col-sm-3">End Date:</dt>
                <dd class="col-sm-9">{{ $sale->endDate->format('Y-m-d') }}</dd>

                <dt class="col-sm-3">Products:</dt>
                <dd class="col-sm-9">
                    @forelse($sale->products as $product)
                        <ul>
                            <li><a href="{{route('admin.products.show', $product)}}">{{$product->name}}</a></li>
                        </ul>
                    @empty
                        <li>No products</li>
                    @endforelse
                </dd>
            </dl>
        </div>
    </div>
@endsection
