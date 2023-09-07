@extends('admin.layouts.base')
@section('title', 'View Category')

@section('header')
    <div class="d-flex">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-link"><i class="fa fa-arrow-left"></i></a>
        <h1>View Category {{$category->name}}</h1>
    </div>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Category Details') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <ul>
                <li>
                    <label for="key">{{ __('Key') }}:</label>
                    <p>{{$category->key}}</p>
                </li>
                <li>
                    <label>{{ __('Name UA') }}:</label>
                    <p>{{$category->transUA('name')}}</p>
                </li>
                <li>
                    <label>{{ __('Name EN') }}:</label>
                    <p>{{$category->transEN('name')}}</p>
                </li>
                <li>
                    <label for="key">{{ __('Description UA') }}</label>
                    <p>{{$category->transUA('description')}}</p>
                </li>
                <li>
                    <label for="key">{{ __('Description EN') }}</label>
                    <p>{{$category->transEN('description')}}</p>
                </li>
                <li>
                    <label for="key">{{ __('Image') }}</label>
                    <p>
                        @if($category->image)
                            <img
                                src="{{ is_url($category->image) ? $category->image : Storage::url($category->image) }}"
                                alt="" width="200px">
                        @else
                            -
                        @endif
                    </p>
                </li>
                <li>
                    <label for="key">{{ __('Parent Category') }}:</label>
                    <p>
                        {{ $category->parent ? $category->parent->name : '-'}}
                    </p>
                </li>
                <li><b>Products:</b>
                    <ul>
                        @forelse($category->products->where('main',1) as $product)
                            <li><a href="{{route('admin.products.show', $product)}}">{{$product->name}}</a></li>
                        @empty
                            <li>No products</li>
                        @endforelse
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{route('admin.categories.edit', $category)}}" class="btn btn-primary">Edit</a>
            <form method="post" action="{{ route('admin.categories.destroy', $category->id) }}" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
            </form>
        </div>
        <!-- /.card-footer -->
    </div>
@endsection
