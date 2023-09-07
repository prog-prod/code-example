@extends('admin.layouts.base')
@section('title', 'Customers')

@section('header')
    <h1>Create Customer</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Create Customer') }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.customers.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                           required autofocus>
                </div>
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                           required>
                </div>
                <div class="form-group">
                    <label for="phone">{{ __('Phone') }}</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}"
                           required>
                </div>
                <div class="form-group">
                    <label for="address">{{ __('Address') }}</label>
                    <textarea name="address" id="address" class="form-control" rows="3"
                              required>{{ old('address') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="city">{{ __('City') }}</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}"
                           required>
                </div>
                <div class="form-group">
                    <label for="state">{{ __('State') }}</label>
                    <input type="text" name="state" id="state" class="form-control" value="{{ old('state') }}"
                           required>
                </div>
                <div class="form-group">
                    <label for="country">{{ __('Country') }}</label>
                    <input type="text" name="country" id="country" class="form-control"
                           value="{{ old('country') }}" required>
                </div>
                <div class="form-group">
                    <label for="postal_code">{{ __('Postal Code') }}</label>
                    <input type="text" name="postal_code" id="postal_code" class="form-control"
                           value="{{ old('postal_code') }}" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    <a href="{{ route('admin.customers.index') }}"
                       class="btn btn-default">{{ __('Cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
