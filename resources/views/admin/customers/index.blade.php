@extends('admin.layouts.base')
@section('title', 'Customers')

@section('header')
    <h1>Customers</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Customers') }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.customers.create') }}"
                   class="btn btn-primary">{{ __('Create') }}</a>
            </div>
        </div>
        <div class="card-body">
            @if ($customers->count())
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Address') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}, {{ $customer->city }}, {{ $customer->state }}
                                , {{ $customer->postal_code }}, {{ $customer->country }}</td>
                            <td>
                                <a href="{{ route('admin.customers.edit', $customer->id) }}"
                                   class="btn btn-primary">{{ __('Edit') }}</a>
                                <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST"
                                      style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No orders in the trash.</p>
            @endif
            <div class="mt-4">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
@endsection
