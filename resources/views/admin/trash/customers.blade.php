@extends('admin.layouts.base')
@section('title', 'Customers Trash')

@section('header')
    <h1><i class="fa fa-trash"></i> Customers Trash</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Customers</h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body">
            @if ($deletedCustomers->count())
                <table class="table table-bordered table-striped">
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
                    @foreach ($deletedCustomers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}, {{ $customer->city }}, {{ $customer->state }}
                                , {{ $customer->postal_code }}, {{ $customer->country }}</td>
                            <td>
                                <form action="{{ route('admin.trash.customers.restore', $customer) }}" method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-primary"><i
                                            class="fa fa-trash-restore"></i>
                                        Restore
                                    </button>
                                </form>
                                <form action="{{ route('admin.trash.customers.destroy', $customer->id) }}" method="POST"
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this customer?')">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
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
                {{ $deletedCustomers->links() }}
            </div>
        </div>
    </div>
@endsection
