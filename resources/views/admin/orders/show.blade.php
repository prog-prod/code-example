@extends('admin.layouts.base')
@section('title', 'Замовлення #'.$order->id)
@section('header')
    <h1>Замовлення #{{$order->id}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Деталі замовлення') }}</h3>
            <div class="card-tools">
                @if($order->isPending())
                    <form action="{{ route('admin.orders.confirm', $order) }}" method="post"
                          class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-success">Підтвердити</button>
                    </form>
                @endif
                @if($order->canAdminCancelOrder())
                    <x-adminlte-button label="Скасувати" theme="danger" data-toggle="modal" data-target="#cancelOrder"/>
                @endif
            </div>
        </div>
        <div class="card-body">
            <x-adminlte-modal id="cancelOrder" title="Скасувати замовлення">
                <form action="{{ route('admin.orders.cancel', $order) }}" method="post" id="cancelOrderForm"
                      class="w-100 d-inline-block">
                    @csrf
                    <p>Вкажіть причину скасування замовлення:</p>
                    @foreach(\App\Enums\ReasonsCancelOrderEnum::cases() as $key => $reason)
                        <div class="form-check">
                            <input type="radio" name="reason" value="{{$reason->value}}" class="form-check-input"
                                   id="radio_reason_{{$key}}" @if($loop->first) checked @endif>
                            <label class="form-check-label" for="radio_reason_{{$key}}">{{$reason->getLabel()}}</label>
                        </div>
                    @endforeach
                    <div class="form-group other_reason_block" style="display: none">
                        <label class="form-check-label" for="other_reason">Інша причина</label>
                        <x-adminlte-textarea id="other_reason" name="other_reason"
                                             placeholder="Iнша причина скасування..."/>
                    </div>
                    <hr>
                    <div class="form-check">
                        <input type="checkbox" name="notify_customer" class="form-check-input" id="notify_customer"
                               checked>
                        <label class="form-check-label" for="notify_customer">Повідомити про скасування
                            замовника.</label>
                    </div>
                    <x-slot name="footerSlot">
                        <button type="button"
                                onclick="if (confirm('Are you sure you want to cancel the order?')) { $('#cancelOrderForm').submit(); }"
                                class="btn btn-danger">Скасувати замовлення
                        </button>

                        <x-adminlte-button label="Закрити вікно" data-dismiss="modal"/>
                    </x-slot>
                </form>
            </x-adminlte-modal>

            <div class="row">
                <div class="col-md-3">
                    <p><strong>{{ __('ID замовлення') }}:</strong> #{{ $order->id }}</p>
                    <p><strong>{{ __('Номер замовлення/Артікул') }}:</strong> {{ $order->order_number }}</p>
                    <p><strong>{{ __('Замовник/Покупець') }}:</strong> <a
                            href="{{route('admin.customers.show', $order->customer)}}">{{ $order->customer->name }}</a>
                    </p>
                    <p><strong>{{ __('Пошта замовника') }}:</strong> {{ $order->customer->email }}</p>
                </div>
                <div class="col-md-3">
                    <p><strong>{{ __('Дата замовлення') }}:</strong> {{ $order->created_at->format('d.m.Y H:i:s') }}</p>
                    <p><strong>{{ __('Загальна сума замовлення') }}
                            :</strong> {{ number_format($order->total_price->getAmount()->toInt(), 2) }} {{$order->currency->code}}
                    </p>
                    <p><strong>{{ __('Статус замовлення') }}:</strong>
                        <x-order-status :status="$order->status"></x-order-status>
                    </p>
                    @if($order->status === \App\Enums\OrderStatusEnum::CANCELED->value)
                        <p><strong>{{ __('Причина скасування') }}:</strong>
                            {{$order->reason}}
                        </p>
                    @endif
                    <p><strong>{{ __('Кі-сть товарів у замовленні') }}:</strong>
                        {{$order->orderItems->count()}}
                    </p>
                </div>
                <div class="col-md-3">
                    <p><strong>{{ __('Платіж') }}:</strong> <a
                            href="{{route('admin.payments.show', $payment)}}">#{{ $payment->id }}</a></p>
                    <p><strong>{{ __('Оплачено суму') }}
                            :</strong> {{ number_format($payment->paidAmount->getAmount()->toInt(), 2) }}
                        / {{ number_format($payment->amount->getAmount()->toInt(), 2) }} {{$order->currency->code}}
                    </p>
                    <p><strong>{{ __('Статус оплати') }}:</strong>
                        <x-payment-status :status="$payment->status"></x-payment-status>
                    </p>
                    <p><strong>{{ __('Метод оплати') }}:</strong>
                        <a
                            href="{{route('admin.payment-methods.index')}}">{{ $payment->paymentMethod->name }}</a>
                    </p>
                </div>
                <div class="col-md-3">
                    <p><strong>{{ __('Передзвонити') }}:</strong>
                        @if($order->callback)
                            Так
                        @else
                            Ні
                        @endif
                    </p>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <h4>{{ __('Товари у замовленні') }}</h4>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>{{ __('Товар') }}</th>
                            <th>{{ __('Ціна / од') }}</th>
                            <th>{{ __('Кількість, од') }}</th>
                            <th>{{ __('Проміжна вартість') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->price->getAmount()->toInt() / $item->quantity }} {{$item->price->getCurrency()}}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price->getAmount() }} {{$item->price->getCurrency()}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const other_val = '{{\App\Enums\ReasonsCancelOrderEnum::OTHER->value}}';
        const other_input_block = $('.other_reason_block');
        $(document).ready(() => {
            $('input[name="reason"]').change(function() {
                if ($(this).val() === other_val) {
                    other_input_block.show();
                } else {
                    other_input_block.hide();
                }
            });
        });
    </script>
@endsection
