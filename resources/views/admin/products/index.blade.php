@extends('admin.layouts.base')
@section('title', 'Products')
@section('plugins.DatatablesPlugin', true)
@section('plugins.Datatables', true)

@section('header')
    <h1>Products</h1>
@stop
@php

    $heads = [
        'ID',
        'Image',
        'Name',
        'Status',
        'Category',
        'Main',
        'Group key',
        'Price',
        'Created At',
        'Updated At',
        ['label' => 'Actions', 'no-export' => true, 'width' => 5],
    ];

    $data = [];

    foreach ($products as $product){
        $btnEdit = ' <a title="Edit Product" href="'.route('admin.products.edit', $product->id) .'"
                                   class="btn btn-link p-0 pr-1"><i class="fa fa-fw fa-pen"></i></a>';
        $btnDelete = ' <form action="'.route('admin.products.destroy-group', $product->key).'" method="POST"
                                      class="d-inline">
                                   <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" href="#" title="Move to Trash" class="btn btn-link p-0"
                                            onclick="return confirm(\'Are you sure you want to move it to trash?\')">
                                        <i
                                            class="fa fa-trash text-danger"></i>
                                    </button>
                                </form>';
        $main_image = $product->main_image
                        ? '<img src="'.Storage::url($product->main_image->filename).'" width="70px" alt="">'
                        : '<img src="'.get_default_image().'" width="70px" alt="">';
        $product_name = '<a href="'.route('admin.products.group', $product->key) .'">'. $product->name .'</a>';
        $product_status = View::make('components.product-status', ['status' => $product->active])->render();
        $product_main = View::make('components.product-main', ['isMain' => $product->main])->render();
        $product_price = View::make('components.product-price', ['price' => $product->price, 'currency' => $product->currency_name, 'priceWithDiscount' => $product->priceWithDiscount, 'styled' => false])->render();
        $product_key = $product->key;
        $product_category = $product->category?->name;
        $product_created_at = $product->created_at;
        $product_updated_at = $product->updated_at;

        $data[] = [
              $product->id, $main_image,$product_name, $product_status, $product_category, $product_main, $product_key, $product_price, $product_created_at, $product_updated_at, '<nobr>'.$btnEdit.$btnDelete.'</nobr>',
        ];
    }

    $config = [
        'data' => $data,
        'order' => [[1, 'asc']],
        "pageLength" => 25
    ];
@endphp
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Products</h2>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Create Product</a>
            </div>
        </div>
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config"></x-adminlte-datatable>
        </div>
    </div>
@endsection

