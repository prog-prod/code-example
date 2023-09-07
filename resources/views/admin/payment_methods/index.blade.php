@extends('admin.layouts.base')
@section('title', 'Payment methods')

@section('header')
    <h1>Методи оплати</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Методи оплати</h3>
            <div class="card-tools">
                <a href="{{ route('admin.payment-methods.create') }}" class="btn btn-primary">Створити новий метод</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Key</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>SMS Template</th>
                    @foreach(\App\Enums\RequisitesFieldsEnum::cases() as $field)
                        <th>{{$field->getLabel()}}</th>
                    @endforeach
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($paymentMethods as $paymentMethod)
                    <tr>
                        <td>{{ $paymentMethod->id }}</td>
                        <td>{{ $paymentMethod->key }}</td>
                        <td>{{ $paymentMethod->name }}</td>
                        <td>{{ $paymentMethod->description }}</td>
                        <td>{{ $paymentMethod->smsTemplate?->name ?? '-' }}</td>
                        @foreach(\App\Enums\RequisitesFieldsEnum::cases() as $field)
                            <td>{{$paymentMethod->requisites[$field->value] ?? '-'}}</td>
                        @endforeach
                        <td>
                            @if($paymentMethod->active)
                                <i class="fa fa-check text-success"></i>
                            @else
                                <i class="fa fa-times text-danger"></i>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.payment-methods.edit', $paymentMethod->id) }}"
                               class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.payment-methods.destroy', $paymentMethod->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this payment method?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No payment methods found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
