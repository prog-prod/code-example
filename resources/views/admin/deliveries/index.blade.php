@extends('admin.layouts.base')
@section('title', 'Layouts')

@section('header')
    <h1>Deliveries</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Deliveries') }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.deliveries.create') }}" class="btn btn-primary mb-3">Create Delivery Method</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Key</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($deliveries as $delivery)
                    <tr>
                        <td>{{ $delivery->id }}</td>
                        <td>{{ $delivery->key }}</td>
                        <td>{{ $delivery->name }}</td>
                        <td>{{ $delivery->description }}</td>
                        <td>{{ $delivery->params }}</td>
                        <td>
                            <a href="{{ route('admin.deliveries.edit', $delivery->id) }}"
                               class="btn btn-sm btn-secondary">Edit</a>
                            <form action="{{ route('admin.deliveries.destroy', $delivery->id) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this delivery method?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
