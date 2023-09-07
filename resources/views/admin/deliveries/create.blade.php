@extends('admin.layouts.base')
@section('title', 'Layouts')

@section('header')
    <h1>Create Delivery</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Create Delivery') }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <h1>Create Delivery Method</h1>

            <form action="{{ route('admin.deliveries.store') }}" method="POST">
                @csrf
                <x-form-control attribute="key"/>
                <x-multi-lang-form-control attribute-name="name" label="Title"/>
                <x-multi-lang-form-control attribute-name="description" label="Description"/>
                <x-form-control form-control-type="textarea" attribute="params" :model="$delivery"/>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
