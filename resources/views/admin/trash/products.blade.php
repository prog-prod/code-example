@extends('admin.layouts.base')
@section('title', 'Products Trash')

@section('header')
    <h1><i class="fa fa-trash"></i> Products Trash</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Products</h2>
                <form action="{{ route('admin.trash.products.destroyAll') }}" method="POST"
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete all products forever?')"><i
                            class="fa fa-trash"></i> Delete All
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($deletedProducts as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a></td>
                        <td>
                            <x-product-price :price="$product->price" :currency="$product->currency_name"
                                             :priceWithDiscount="$product->priceWithDiscount"/>
                        </td>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->updated_at }}</td>
                        <td>
                            <form action="{{ route('admin.trash.products.restore', $product) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-trash-restore"></i>
                                    Restore
                                </button>
                            </form>
                            <form action="{{ route('admin.trash.products.destroy', $product) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete it forever?')"><i
                                        class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $deletedProducts->links() }}
        </div>
    </div>
@endsection

