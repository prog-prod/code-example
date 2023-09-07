@extends('admin.layouts.base')
@section('title', 'Review '.$review->id)
@section('header')
    <h1>Review #{{$review->id}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Review Details') }}</h3>
            <h3 class="card-tools">
                <a href="{{ route('admin.reviews.index') }}"
                   class="btn btn-secondary"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
                <a href="{{ route('admin.reviews.edit', $review) }}"
                   class="btn btn-warning">{{ __('Edit') }}</a>
                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST"
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </form>
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>{{ __('Product Name') }}:</strong> {{ $review->product->name }}</p>
                    <p><strong>{{ __('User') }}:</strong> {{ $review->user->name }}</p>
                    <p><strong>{{ __('Title') }}:</strong> {{ $review->title }}</p>
                    <p><strong>{{ __('Body') }}:</strong> {{ $review->body }}</p>
                    <p><strong>{{ __('Rating') }}:</strong> {{ $review->rating }}</p>
                    <p><strong>{{ __('Created At') }}:</strong> {{ $review->created_at }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
