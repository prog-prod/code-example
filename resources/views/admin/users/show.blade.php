@extends('admin.layouts.base')
@section('title', 'User '. $user->name)

@section('header')
    <h1>View User {{$user->name}}</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('User Details') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th scope="row">{{ __('Name') }}</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Email') }}</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Role') }}</th>
                                <td>{{ $user->role }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                           class="btn btn-primary">{{ __('Edit') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
