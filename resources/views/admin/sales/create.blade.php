@extends('admin.layouts.base')
@section('title', 'Sales')

@section('header')
    <h1>Sales</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Sale</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sales.store') }}" method="POST">
                @csrf
                <x-form-control attribute="key"/>
                <x-multi-lang-form-control attribute-name="name"/>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity"
                           class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}"
                           required>
                    @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="percent">Percent</label>
                    <input type="number" name="percent" id="percent"
                           min="1" max="100"
                           class="form-control @error('percent') is-invalid @enderror" value="{{ old('percent') }}"
                           required>
                    @error('percent')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="endDate">End Date</label>
                    <input type="date" name="endDate" id="endDate"
                           class="form-control @error('endDate') is-invalid @enderror" value="{{ old('endDate') }}"
                           required>
                    @error('endDate')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add Sale</button>
            </form>
        </div>
    </div>
@endsection
