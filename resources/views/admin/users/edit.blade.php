@extends('admin.layouts.base')
@section('title', 'Edit '. $user->name)

@section('header')
    <h1>Edit User {{$user->name}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Edit User') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}"
                           required>
                </div>
                <div class="form-group">
                    <label for="email">{{ __('Email address') }}</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="form-group">
                    <label for="role">{{ __('Role') }}</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>{{ __('Admin') }}</option>
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>{{ __('User') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        {{ __('Leave password field blank if you do not want to change the user\'s password.') }}
                    </small>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
@endsection
