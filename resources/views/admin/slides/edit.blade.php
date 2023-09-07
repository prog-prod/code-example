@extends('admin.layouts.base')
@section('title', 'Edit slide')
@section('plugins.BootstrapColorpicker', true)
@section('plugins.Summernote', true)

@section('header')
    <h1>Edit Slide</h1>
@stop

@php
    $configText = [
       "height" => 100,
   ]
@endphp
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                {{ __('Create New Slide') }}
            </div>
            <div class="card-tools">
                <a href="{{ route('admin.sliders.show', $slide->slider) }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-angle-double-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.slides.update', $slide) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <x-adminlte-select2 id="sel2Slider" placeholder="Select slider"
                                        class="form-control{{ $errors->has('slider_id') ? ' is-invalid' : '' }}"
                                        name="slider_id" label="Slider" required>
                        @foreach($sliders as $sl)
                            <option
                                value="{{ $sl->id }}"{{ old('slider_id', $slide->slider->id) == $sl->id ? ' selected' : '' }}>{{ $sl->name }}</option>
                        @endforeach
                    </x-adminlte-select2>

                    @if ($errors->has('slider_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('slider_id') }}</strong>
                        </span>
                    @endif
                </div>
                <x-multi-lang-form-control attribute-name="title" :model="$slide"/>
                <div class="form-group">
                    <label for="order">{{ __('Order') }}</label>
                    <input id="order" type="number" name="order"
                           class="form-control  {{ $errors->has('order') ? ' is-invalid' : '' }}"
                           value="{{ old('order', $slide->order) }}"/>
                    @if ($errors->has('order'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('order') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="imageWebpMobile">{{ __('Image WebP (Mobile):') }}</label>
                    <img src="{{ Storage::url($slide->image_webp_mobile) }}" alt="" width="100">
                    <input
                        id="imageWebpMobile"
                        type="file"
                        name="image_webp_mobile"
                        class="form-control-file {{ $errors->has('image_webp_mobile') ? ' is-invalid' : '' }}"
                        accept="image/webp"
                    />
                    @if ($errors->has('image_webp_mobile'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('image_webp_mobile') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="imageJpgMobile">{{ __('Image JPEG (Mobile):') }}</label>
                    <img src="{{ Storage::url($slide->image_jpg_mobile) }}" alt="" width="100">
                    <input
                        id="imageJpgMobile"
                        type="file"
                        name="image_jpg_mobile"
                        class="form-control-file {{ $errors->has('image_jpg_mobile') ? ' is-invalid' : '' }}"
                        accept="image/jpeg"
                    />
                    @if ($errors->has('image_jpg_mobile'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('image_jpg_mobile') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="imageWebpDesktop">{{ __('Image WebP (Desktop):') }}</label>
                    <img src="{{ Storage::url($slide->image_webp_desktop) }}" alt="" width="100">
                    <input
                        id="imageWebpDesktop"
                        type="file"
                        name="image_webp_desktop"
                        class="form-control-file {{ $errors->has('image_webp_desktop') ? ' is-invalid' : '' }}"
                        accept="image/webp"
                    />
                    @if ($errors->has('image_webp_desktop'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('image_webp_desktop') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="imageJpgDesktop">{{ __('Image JPEG (Desktop):') }}</label>
                    <img src="{{ Storage::url($slide->image_jpg_desktop) }}" alt="" width="100">
                    <input
                        id="imageJpgDesktop"
                        type="file"
                        name="image_jpg_desktop"
                        class="form-control-file {{ $errors->has('image_jpg_desktop') ? ' is-invalid' : '' }}"
                        accept="image/jpeg"
                    />
                    @if ($errors->has('image_jpg_desktop'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('image_jpg_desktop') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="imageJpg">{{ __('Image default (JPG):') }}</label>
                    <img src="{{ Storage::url($slide->image_jpg) }}" alt="" width="100">
                    <input
                        id="imageJpg"
                        type="file"
                        name="image_jpg"
                        class="form-control-file {{ $errors->has('image_jpg') ? ' is-invalid' : '' }}"
                        accept="image/jpeg"
                    />
                    @if ($errors->has('image_jpg'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('image_jpg') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="link_url">{{ __('Link') }}</label>
                                <input id="link_url" type="text" name="link_url"
                                       class="form-control  {{ $errors->has('link_url') ? ' is-invalid' : '' }}"
                                       value="{{ old('link_url', $slide->link_url) }}"/>
                                @if ($errors->has('link_url'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('link_url') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __('Update Slide') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
