@extends('admin.layouts.base')
@section('title', 'Layouts')

@section('header')
    <h1>Layouts</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">{{ __('Layouts') }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.layouts.create') }}" class="btn btn-primary">{{ __('Add Layout') }}</a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($layouts as $layout)
                    <tr>
                        <td>{{ $layout->id }}</td>
                        <td>{{ $layout->name }}</td>
                        <td>
                            <a href="{{ route('admin.layouts.edit', $layout) }}"
                               class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                            <form action="{{ route('admin.layouts.destroy', $layout) }}" method="POST"
                                  class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
