@extends('admin.layouts.base')
@section('title', 'Orders Trash')

@section('header')
    <h1><i class="fa fa-trash"></i> Orders Trash</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Orders</h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body">
            @if ($deletedOrders->count())
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Percent</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($deletedOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->formatted_total }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                <form action="{{ route('admin.trash.orders.restore', $order) }}" method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-primary"><i
                                            class="fa fa-trash-restore"></i>
                                        Restore
                                    </button>
                                </form>
                                <form action="{{ route('admin.trash.orders.destroy', $order->id) }}" method="POST"
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this order?')">
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
                {{ $deletedOrders->links() }}
            </div>
        </div>
    </div>
@endsection
