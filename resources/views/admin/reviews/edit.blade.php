@extends('admin.layouts.base')
@section('title', 'Edit Review #'.$review->id)
@section('header')
    <h1>Edit Review #{{$review->id}}</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">{{ __('Edit Review') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.reviews.update', $review) }}">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="product_id">{{ __('Product') }}</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}"
                                                @if($review->product_id === $product->id) selected @endif>{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="user_id">{{ __('User') }}</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}"
                                                @if($review->user_id === $user->id) selected @endif
                                        >{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title">{{ __('Title') }}</label>
                                <input type="text" name="title" id="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title', $review->title) }}">
                                @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="body">{{ __('Body') }}</label>
                                <textarea name="body" id="body"
                                          class="form-control @error('body') is-invalid @enderror">{{ old('body', $review->body) }}</textarea>
                                @error('body')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="rating">{{ __('Rating') }}</label>
                                <select name="rating" id="rating" class="form-control">
                                    @foreach([1,2,3,4,5] as $rating)
                                        <option value="{{$rating}}"
                                                @if($rating === $review->rating) selected @endif>{{$rating}}</option>
                                    @endforeach
                                </select>
                                @error('rating')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
