@extends('admin.layouts.base')
@section('title', 'Reviews')
@section('header')
    <h1>Reviews</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Reviews') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.reviews.create') }}"
                               class="btn btn-primary">{{ __('Create') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Product') }}</th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Body') }}</th>
                                <th>{{ __('Rating') }}</th>
                                <th>{{ __('Created at') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>{{ $review->id }}</td>
                                    <td>{{ $review->product->name }}</td>
                                    <td>{{ $review->user->name }}</td>
                                    <td>{{ $review->title }}</td>
                                    <td>{{ $review->body }}</td>
                                    <td>{{ $review->rating }}</td>
                                    <td>{{ $review->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.reviews.show', $review) }}"
                                           class="btn btn-primary">{{ __('Show') }}</a>
                                        <a href="{{ route('admin.reviews.edit', $review) }}"
                                           class="btn btn-warning">{{ __('Edit') }}</a>
                                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
