@extends('admin.layouts.base')
@section('title', 'Sales Trash')

@section('header')
    <h1><i class="fa fa-trash"></i> Sales Trash</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sales</h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body">
            @if ($deletedSales->count())
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
                    @foreach ($deletedSales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->name }}</td>
                            <td>{{ $sale->quantity }}</td>
                            <td>{{ $sale->percent }}</td>
                            <td>{{ $sale->endDate->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('admin.trash.sales.restore', $sale) }}" method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-primary"><i
                                            class="fa fa-trash-restore"></i>
                                        Restore
                                    </button>
                                </form>
                                <form action="{{ route('admin.trash.sales.destroy', $sale->id) }}" method="POST"
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this sale?')">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No sales in the trash.</p>
            @endif
            <div class="mt-4">
                {{ $deletedSales->links() }}

            </div>
        </div>
    </div>
@endsection
