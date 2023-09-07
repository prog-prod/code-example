@extends('admin.layouts.base')
@section('title', 'View slide')
@section('plugins.BootstrapColorpicker', true)

@section('header')
    <h1>View Slide</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $slide->title }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.sliders.show', $slide->slider) }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-angle-double-left"></i> Back
                </a>
                <a href="{{ route('admin.slides.edit', $slide->id) }}" class="btn btn-sm btn-success">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.slides.destroy', $slide->id) }}" method="POST"
                      style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this slide?')">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-6">
                    <h5>Order:</h5>
                    <p>{{ $slide->order }}</p>
                    <h5>Link:</h5>
                    <p>{{ $slide->link_url }}</p>
                    <h5>Image JPG:</h5>
                    <p>
                        <img src="{{ Storage::url($slide->image_jpg) }}" alt="{{ $slide->title }}" class="img-fluid">
                    </p>
                    <h5>Image Webp (mobile):</h5>
                    <p><img src="{{ Storage::url($slide->image_webp_mobile) }}" alt="{{ $slide->title }}"
                            class="img-fluid"></p>
                    <h5>Image JPG (mobile):</h5>
                    <p><img src="{{ Storage::url($slide->image_jpg_mobile) }}" alt="{{ $slide->title }}"
                            class="img-fluid"></p>
                    <h5>Image Webp (desktop):</h5>
                    <p><img src="{{ Storage::url($slide->image_webp_desktop) }}" alt="{{ $slide->title }}"
                            class="img-fluid"></p>
                    <h5>Image JPG (desktop):</h5>
                    <p><img src="{{ Storage::url($slide->image_jpg_desktop) }}" alt="{{ $slide->title }}"
                            class="img-fluid"></p>
                </div>
            </div>
        </div>
    </div>
@endsection
