@extends('admin.layouts.base')
@section('title', 'Customer '.$customer->name)

@section('header')
    <h1>Customer {{$customer->name}}</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Customer '.$customer->name) }}</h3>
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $customer->name }}</h4>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $customer->email }}</h6>
                    <p class="card-text">Phone: {{ $customer->phone }}</p>
                    <p class="card-text">Address: {{ $customer->address }}, {{ $customer->city }}
                        , {{ $customer->state }}, {{ $customer->country }} {{ $customer->postal_code }}</p>
                    <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection
