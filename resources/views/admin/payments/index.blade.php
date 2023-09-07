@extends('admin.layouts.base')
@section('title', 'Payment methods')

@section('header')
    <h1>Payments</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Payments</h3>
            <div class="card-tools">
                <a href="{{ route('admin.payments.create') }}" class="btn btn-primary mb-3">Create Payment</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Payment Method ID</th>
                    <th>Status</th>
                    <th>Order ID</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td><a href="{{route('admin.payments.index')}}">{{ $payment->paymentMethod->name }}</a></td>
                        <td>
                            <x-payment-status :status="$payment->status"></x-payment-status>
                        </td>
                        <td>
                            @if($payment->order)
                                <a href="{{route('admin.orders.show', $payment->order_id)}}">#{{$payment->order_id}}</a>
                            @else
                                #{{$payment->order_id}}
                            @endif
                        </td>
                        <td>{{ $payment->amount }}</td>
                        <td>
                            <a href="{{ route('admin.payments.show', $payment->id) }}" class="btn btn-sm btn-primary">View</a>
                            <a href="{{ route('admin.payments.edit', $payment->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this payment?')">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
