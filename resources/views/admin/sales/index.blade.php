@extends('admin.layouts.base')
@section('title', 'Sales')

@section('header')
    <h1>Sales</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Sales</h3>
            <div class="card-tools">
                <a href="{{ route('admin.sales.create') }}" class="btn btn-primary btn-sm">Add Sale</a>
            </div>
        </div>
        <div class="card-body">
            @if ($sales->count())
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Percent</th>
                        <th>End Date</th>
                        <th>Products</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->name }}</td>
                            <td>{{ $sale->quantity }}</td>
                            <td><b>{{ $sale->percent }}%</b></td>
                            <td>{{ $sale->endDate->format('Y-m-d') }}</td>
                            <td>{{ $sale->products->count() }}</td>
                            <td>
                                <a href="{{ route('admin.sales.show', $sale) }}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{ route('admin.sales.edit', $sale) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.sales.destroy', $sale) }}" method="POST"
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this sale?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No sales found.</p>
            @endif
            <div class="mt-4">
                {{ $sales->links() }}

            </div>
        </div>
    </div>
@endsection
