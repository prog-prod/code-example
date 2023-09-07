@extends('admin.layouts.base')
@section('title', 'Create new user')

@section('header')
    <h1>Create new user</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Create User') }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                           required>
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                           required>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Create User') }}</button>
            </form>
        </div>
    </div>
@endsection
