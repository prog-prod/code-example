@extends('admin.layouts.base')
@section('title', 'Reviews Trash')

@section('header')
    <h1><i class="fa fa-trash"></i> Reviews Trash</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Reviews</h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body">
            @if ($deletedReviews->count())
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
                    @foreach ($deletedReviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td>{{ $review->product->name }}</td>
                            <td>{{ $review->user->name }}</td>
                            <td>{{ $review->title }}</td>
                            <td>{{ $review->body }}</td>
                            <td>{{ $review->rating }}</td>
                            <td>{{ $review->created_at }}</td>
                            <td>
                                <form action="{{ route('admin.trash.reviews.restore', $review) }}" method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-primary"><i
                                            class="fa fa-trash-restore"></i>
                                        Restore
                                    </button>
                                </form>
                                <form action="{{ route('admin.trash.reviews.destroy', $review->id) }}" method="POST"
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this review?')">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No reviews in the trash.</p>
            @endif
            <div class="mt-4">
                {{ $deletedReviews->links() }}
            </div>
        </div>
    </div>
@endsection
