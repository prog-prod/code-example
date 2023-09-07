@extends('admin.layouts.base')
@section('title', 'Адміністратори')

@section('header')
    <h1>Адміністратори</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <a href="{{ route('admin.admin-users.create') }}" class="btn btn-primary btn-sm">Add</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>API Token</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td><a href="{{route('admin.admin-users.show', $admin)}}">{{ $admin->name }}</a></td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->api_token }}</td>
                        <td>{{ $admin->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.admin-users.show', $admin->id) }}"
                               class="btn btn-primary btn-sm">View</a>
                            <a href="{{ route('admin.admin-users.edit', $admin->id) }}"
                               class="btn btn-warning btn-sm">Edit</a>
                            @if(!$superadmins->contains($admin))
                                <form action="{{ route('admin.admin-users.destroy', $admin->id) }}" method="POST"
                                      style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this Admin?')">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
