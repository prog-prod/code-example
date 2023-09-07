@extends('admin.layouts.base')
@section('title', 'Layouts')

@section('header')
    <h1>Edit Delivery</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Edit Delivery') }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <h1>Edit Delivery Method</h1>

            <form action="{{ route('admin.deliveries.update', $delivery->id) }}" method="POST">
                @csrf
                @method('PUT')
                <x-form-control attribute="key" :model="$delivery"/>
                <x-multi-lang-form-control attribute-name="name" label="Title" :model="$delivery"/>
                <x-multi-lang-form-control attribute-name="description" label="Description" :model="$delivery"/>
                <x-form-control form-control-type="textarea" attribute="params" :model="$delivery"/>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
