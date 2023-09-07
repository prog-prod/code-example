@extends('admin.layouts.base')
@section('title', 'Платіж #'.$payment->id)

@section('header')
    <h1>Платіж #{{$payment->id}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Платіж #{{$payment->id}}</h3>
            <div class="card-tools">
                @if($payment->canAdminConfirmPayment())
                    <form action="{{ route('admin.payments.confirm', $payment) }}" method="post" id="confirmPaymentForm"
                          class="d-inline-block">
                        @csrf
                        <button type="button"
                                onclick="if (confirm('Ви впевнені що хочете підтвердити оплату?')) { $('#confirmPaymentForm').submit(); }"
                                class="btn btn-success">Підтвердити оплату
                        </button>
                    </form>
                @endif
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                <tr>
                    <th>Метод оплати:</th>
                    <td><a href="{{route('admin.payment-methods.index')}}"></a>{{ $payment->paymentMethod->name }}</td>
                </tr>
                <tr>
                    <th>Статус:</th>
                    <td>
                        <x-payment-status :status="$payment->status"></x-payment-status>
                    </td>
                </tr>
                <tr>
                    <th>Замовлення:</th>
                    <td>
                        @if($payment->order)
                            <a href="{{route('admin.orders.show', $payment->order)}}">#{{ $payment->order->id }}</a>
                        @else
                            #{{ $payment->order_id }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Сума платежу:</th>
                    <td>{{ $payment->amount->getAmount() }} {{ $payment->amount->getCurrency() }}</td>
                </tr>
                <tr>
                    <th>Оплачено:</th>
                    <td> {{$payment->paidAmount->getAmount()->toInt()}}
                        / {{$payment->amount->getAmount()->toInt()}} {{$payment->currency_name}}</td>
                </tr>
                </tbody>
            </table>
            <div class="d-flex">
                <h4 class="mt-4 mb-4">Транзакції платежу</h4>
            </div>
            <table class="table">
                <tbody>
                <tr>
                    <th>ID Транзакції</th>
                    <th>Cума</th>
                    <th>ID Рахунку банка</th>
                    <th>Рахунок</th>
                    <th>Дата платежу</th>
                    <th>Коментар транзакції</th>
                </tr>
                @forelse($payment->transactions as $transaction)
                    <tr>
                        <td>{{$transaction->id}}</td>
                        <td>{{$transaction->amount->getAmount()}}</td>
                        <td>{{$transaction->account_id}}</td>
                        <td>{{\App\Enums\MonoAccountTypeEnum::from($transaction->account_type)->getLabel()}}</td>
                        <td>{{ \Carbon\Carbon::createFromTimestamp($transaction->detailsObject->time)->format('d.m.Y H:i:s') ?? '-'}}</td>
                        <td>
                            {{$transaction->detailsObject->comment}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">
                            Нема транзакцій
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
