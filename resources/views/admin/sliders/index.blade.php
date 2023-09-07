@extends('admin.layouts.base')
@section('title', 'Sliders')

@section('header')
    <h1>Sliders</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sliders</h3>
            <div class="card-tools">
                <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary btn-sm">Create Slider</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Background Color</th>
                    <th>Arrows</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($sliders as $slider)
                    <tr>
                        <td>{{ $slider->id }}</td>
                        <td>{{ $slider->name }}</td>
                        <td>{{ $slider->background_color ?? '-' }}</td>
                        <td>{{ $slider->arrows ? 'Yes' : 'No' }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.sliders.show', $slider->id) }}"
                                   class="btn btn-warning btn-sm mr-2">Show</a>
                                <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                                   class="btn btn-primary btn-sm mr-2">Edit</a>
                                <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            There are no sliders.

                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
