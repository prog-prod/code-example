@extends('admin.layouts.base')
@section('title', 'Редагування Замовлення № '. $order->id)
@section('plugins.Select2', true)

@section('header')
    <h1>Редагування Замовлення № {{$order->id}}</h1>
@stop
@php
    $config_select2 = [
        "allowClear" => true
    ];
@endphp

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Редагування замовлення') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.orders.update', $order) }}">
                @csrf
                @method('PUT')
                <x-adminlte-select2 id="sel2customer" label="Замовник"
                                    name="customer_id"
                                    :config="array_merge($config_select2,['placeholder' => 'Select customer'])">
                    @foreach($customers as $customer)
                        <option
                            value="{{$customer->id}}" {{ $customer->id === old('customer_id', $order->customer_id) ? 'selected' : '' }}>{{$customer->name}}</option>
                    @endforeach
                </x-adminlte-select2>
                <x-form-control attribute="order_number" :model="$order"/>
                <x-form-control attribute="total_price" :model="$order" :readonly="true"/>
                <x-boolean-select attribute="callback" label="Передзвонювати" :model="$order"/>
                <x-form-control attribute="name" :label="'Метод оплати'" :model="$order->payment->paymentMethod"
                                :readonly="true"/>
                <div class="form-group">
                    <label for="#order-status">Статус замовлення</label>
                    <div>
                        <x-order-status id="order-status" :status="$order->status"></x-order-status>
                    </div>
                </div>
                <x-adminlte-select2 id="sel2orderItems" label="Товари у замовленні"
                                    name="order_items[]"
                                    :config="array_merge($config_select2,['placeholder' => 'Виберіть товари'])"
                                    multiple>
                    @foreach($products as $product)
                        <option
                            value="{{$product->id}}" {{ in_array($product->id, old('order_items', $order->orderItems->pluck('product_id')->toArray())) ? 'selected' : '' }}>{{$product->name}}
                            ({{$product->id}})
                        </option>
                    @endforeach
                </x-adminlte-select2>
                <div class="product-quantity-block">
                    @foreach($order->orderItems as $orderItem)
                        <div class="form-group">
                            <label for="#quantity">Кількість продукта {{$orderItem->product_id}}:</label>
                            <input type="text" name="quantity_mapper[{{$orderItem->product_id}}]" id="quantity"
                                   class="form-control"
                                   value="{{ old('quantity_mapper['.$orderItem->product_id.']', $orderItem->quantity) }}">
                        </div>
                    @endforeach
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Обновити замовлення') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(() => {
            const $productQuantityBlock = $('.product-quantity-block');
            $('#sel2orderItems').change(function() {
                const products = $(this).val();
                let $blocks = '';
                products.forEach(product => {
                    $blocks += `<div class="form-group">
                            <label for="#quantity">Кількість продукта ${product}:</label>
                            <input type="text" name="quantity_mapper[${product}]" id="quantity"
                                   class="form-control"
                                   value="1">
                        </div>`;
                });
                $productQuantityBlock.html($blocks);
            });
        });
    </script>
@endsection
