@extends('admin.layouts.base')
@section('title', 'Замовлення')
@section('plugins.DatatablesPlugin', true)
@section('plugins.Datatables', true)
@section('header')
    <h1>Замовлення</h1>
@stop
@php

    $heads = [
        'ID',
        'Замовник',
        'Артікул',
        'Сума замовлення',
        'Передзвонити',
        'Метод оплати',
        'Статус',
        'Дата створення',
        ['label' => 'Дії', 'no-export' => true, 'width' => 5],
    ];

    $data = [];

     foreach ($orders as $order){
        $btnEdit = ' <a title="Edit Order" href="'.route('admin.orders.edit', $order) .'"
                                   class="btn btn-link p-0 pr-1"><i class="fa fa-fw fa-pen"></i></a>';
        $btnDelete = ' <form action="'.route('admin.orders.destroy', $order).'" method="POST"
                                      class="d-inline">
                                   <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" href="#" title="Move to Trash" class="btn btn-link p-0"
                                            onclick="return confirm(\'Are you sure you want to move it to trash?\')">
                                        <i
                                            class="fa fa-trash text-danger"></i>
                                    </button>
                                </form>';
        $btnShow = ' <a title="Show Order" href="'.route('admin.orders.show', $order) .'"
                                   class="btn btn-link p-0 pr-1 text-success"><i class="fa fa-fw fa-eye"></i></a>';
        $id = '<a href="'.route('admin.orders.show', $order->id) .'">'. $order->id .'</a>';
        $order_customer_name = $order->customer->name;
        $order_number = $order->order_number;
        $order_total = number_format($order->total_price->getAmount()->toInt(), 2) . " ". $order->currency_name ;
        $order_callback = $order->callback ? '<i class="fa fa-plus text-success"></i>': '<i class="fa fa-minus text-dark"></i>';
        $order_payment_method = $order->payment->paymentMethod->name;
        $order_status = \View::make('components.order-status', ['status' =>  \App\Enums\OrderStatusEnum::from($order->status)])->render();
        $product_created_at = $order->created_at->format('d.m.Y H:i:s');

        $data[] = [
             $id,
             $order_customer_name,
             $order_number,
             $order_total,
             $order_callback,
             $order_payment_method,
             $order_status,
             $product_created_at,
               '<nobr>'.$btnShow.$btnEdit.$btnDelete.'</nobr>',
        ];
    }

    $config = [
        'data' => $data,
        'order' => [[0, 'desc']],
        "pageLength" => 25
    ];
@endphp
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Замовлення') }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.orders.create') }}"
                   class="btn btn-sm btn-primary">{{ __('Створити замовлення') }}</a>
            </div>
        </div>
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config"></x-adminlte-datatable>
        </div>
    </div>
@endsection
