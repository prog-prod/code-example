@extends('admin.layouts.base')
@section('title', 'Products')

@section('header')
    <div class="d-flex">
        <a href="{{ route('admin.products.index') }}" class="btn btn-link"><i
                class="fa fa-arrow-left"></i></a>
        <h1>Products group {{$key}}</h1>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Products</h2>
                <a href="{{ route('admin.products.create', [ 'group' => $key]) }}" class="btn btn-primary">Create
                    Product</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Main</th>
                    <th>Slug</th>
                    <th>Category</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th width="140px">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if($product->main_image)
                                <img src="{{Storage::url($product->main_image->filename)}}" width="70px" alt="">
                            @else
                                <img src="{{get_default_image()}}" width="70px" alt="">
                            @endif
                        </td>
                        <td><a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a></td>
                        <td>
                            <x-product-status :status="$product->active"></x-product-status>
                        </td>
                        <td>
                            <x-product-main :is-main="$product->main"></x-product-main>
                        </td>
                        <td>
                            {{$product->slug }}
                        </td>
                        <td>
                            <a href="{{ route('admin.categories.show', $product->category_id)}}">{{$product->category->name}}</a>
                        </td>
                        <td>@if($product->size)
                                <a href="{{route('admin.sizes.show',$product->size->id)}}">{{ $product->size->name }}</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>@if($product->color)
                                <a href="{{route('admin.colors.show',$product->color?->id)}}">
                                    <x-color-badge
                                        :color="$product->color->hex_code"></x-color-badge> {{ $product->color->name }}
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <x-product-price :price="$product->price" :currency="$product->currency_name"
                                             :priceWithDiscount="$product->priceWithDiscount"/>
                        </td>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->updated_at }}</td>
                        <td>
                            <a href="{{ route('admin.products.show', $product->id) }}" title="View Product"
                               class="btn btn-link text-warning p-0"><i
                                    class="fa fa-eye"></i></a>
                            <a title="Edit Product" href="{{ route('admin.products.edit', $product->id) }}"
                               class="btn btn-link  p-0"><i
                                    class="fa fa-edit"></i></a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" href="#" title="Move to Trash" class="btn btn-link  p-0"
                                        onclick="return confirm('Are you sure you want to move it to trash?')">
                                    <i
                                        class="fa fa-trash text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
@endsection

