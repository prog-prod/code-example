@extends('admin.layouts.base')
@section('title', 'Admin '. $adminUser->name)

@section('header')
    <h1>View Admin {{$adminUser->name}}</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Admin Details') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th scope="row">{{ __('Name') }}</th>
                                <td>{{ $adminUser->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Email') }}</th>
                                <td>{{ $adminUser->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('API Token') }}</th>
                                <td>{{ $adminUser->api_token ?? '-'}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('admin.admin-users.edit', $adminUser->id) }}"
                           class="btn btn-primary">{{ __('Edit') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
