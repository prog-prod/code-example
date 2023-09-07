@extends('admin.layouts.base')
@section('title', 'Create Order')
@section('header')
    <h1>Create Order</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Create Order') }}</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.orders.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="customer_name">{{ __('Customer Name') }}</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name"
                                   value="{{ old('customer_name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="customer_email">{{ __('Customer Email') }}</label>
                            <input type="email" class="form-control" id="customer_email" name="customer_email"
                                   value="{{ old('customer_email') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="total">{{ __('Total') }}</label>
                            <input type="number" class="form-control" id="total" name="total" value="{{ old('total') }}"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
