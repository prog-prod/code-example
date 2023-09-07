@extends('admin.layouts.base')
@section('title', 'Edit Payment')

@section('header')
    <h1>Edit Payment</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Payment</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="payment_method_id">Payment Method ID:</label>
                    <input type="text" name="payment_method_id" id="payment_method_id" class="form-control"
                           value="{{ $payment->payment_method_id }}" required>
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" name="status" id="status" class="form-control" value="{{ $payment->status }}"
                           required>
                </div>

                <div class="form-group">
                    <label for="order_id">Order ID:</label>
                    <input type="text" name="order_id" id="order_id" class="form-control"
                           value="{{ $payment->order_id }}" required>
                </div>

                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="text" name="amount" id="amount" class="form-control" value="{{ $payment->amount }}"
                           required>
                </div>

                <div class="form-group">
                    <label for="details">Details:</label>
                    <textarea name="details" id="details" class="form-control">{{ $payment->details }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
