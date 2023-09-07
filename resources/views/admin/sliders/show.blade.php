@extends('admin.layouts.base')
@section('title', 'Slider '.$slider->name)

@section('header')
    <h1>View Slider {{$slider->name}}</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><b>Slides:</b></h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.slides.create', ['slider' => $slider->id]) }}"
                           class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i> Add Slide
                        </a>
                        <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-edit"></i> Edit Slider
                        </a>
                        <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this slider?')">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Order</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>URL</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($slider->slides as $slide)
                            <tr>
                                <td>{{ $slide->order }}</td>
                                <td>{{ $slide->title }}</td>
                                <td>
                                    <img src="{{ Storage::url($slide->image_jpg) }}" alt="{{ $slide->title }}"
                                         width="100">
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.slides.show', $slide->id) }}"
                                           class="btn btn-primary btn-sm">Show</a>
                                        <a href="{{ route('admin.slides.edit', $slide->id) }}"
                                           class="btn btn-info btn-sm">Edit</a>
                                        <form
                                            action="{{ route('admin.slides.destroy', [ 'slide' => $slide, 'slider' => $slider]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this slide?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    There are no slides.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
