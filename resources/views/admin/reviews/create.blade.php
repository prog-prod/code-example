@extends('admin.layouts.base')
@section('title', 'Create Review')
@section('plugins.Select2', true)

@section('header')
    <h1>Create Review</h1>
@stop
@php
    $config_select2 = [
        "allowClear" => true
    ];
@endphp

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Create Review') }}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.reviews.store') }}">
                @csrf
                <div class="form-group">
                    <x-adminlte-select2 id="sel2Product" label="Product"
                                        name="product_id"
                                        :config="array_merge($config_select2,['placeholder' => 'Select product'])">
                        @foreach($products as $product)
                            <option
                                value="{{$product->id}}" {{ $product->id === old('product') ? 'selected' : '' }}>{{$product->name}}</option>
                        @endforeach
                    </x-adminlte-select2>
                </div>
                <div class="form-group">
                    <x-adminlte-select2 id="sel2User" label="User"
                                        name="user_id"
                                        :config="array_merge($config_select2,['placeholder' => 'Select user'])">
                        @foreach($users as $user)
                            <option
                                value="{{$user->id}}" {{ $user->id === old('user') ? 'selected' : '' }}>{{$user->name}}</option>
                        @endforeach
                    </x-adminlte-select2>
                </div>
                <div class="form-group">
                    <label for="title">{{ __('Title') }}</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}">
                    @error('title')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="body">{{ __('Body') }}</label>
                    <textarea name="body" id="body"
                              class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
                    @error('body')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="rating">{{ __('Rating') }}</label>
                    <select name="rating" id="rating" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    @error('rating')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </form>
        </div>
    </div>
@endsection
