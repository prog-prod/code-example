@extends('admin.layouts.base')
@section('title', 'Create slide')
@section('plugins.BootstrapColorpicker', true)
@section('plugins.BootstrapSwitch', true)
@section('plugins.Summernote', true)

@section('header')
    <h1>Create Slide</h1>
@stop
@php
    $configText = [
       "height" => 100,
   ]
@endphp
@section('content')
    <div class="card">
        <div class="card-header">{{ __('Create New Slide') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.slides.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <x-adminlte-select2 id="sel2Slider" placeholder="Select slider"
                                        class="form-control{{ $errors->has('slider_id') ? ' is-invalid' : '' }}"
                                        name="slider_id" label="Slider" required>
                        @foreach($sliders as $sl)
                            <option
                                value="{{ $sl->id }}"{{ old('slider_id') == $sl->id ? ' selected' : '' }}>{{ $sl->name }}</option>
                        @endforeach
                    </x-adminlte-select2>

                    @if ($errors->has('slider_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('slider_id') }}</strong>
                        </span>
                    @endif
                </div>
                <x-multi-lang-form-control attribute-name="title"/>
                <div class="form-group">
                    <label for="order">{{ __('Order') }}</label>
                    <input id="order" type="number" name="order" min="1"
                           class="form-control  {{ $errors->has('order') ? ' is-invalid' : '' }}"
                           value="{{ old('order', 1) }}" required/>
                    @if ($errors->has('order'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('order') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="imageWebpMobile">{{ __('Image WebP (Mobile):') }}</label>
                    <input
                        id="imageWebpMobile"
                        type="file"
                        name="image_webp_mobile"
                        class="form-control-file {{ $errors->has('imageWebpMobile') ? ' is-invalid' : '' }}"
                        accept="image/webp"
                    />
                    @if ($errors->has('imageWebp'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('imageWebp') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="imageJpgMobile">{{ __('Image JPEG (Mobile):') }}</label>
                    <input
                        id="imageJpgMobile"
                        type="file"
                        name="image_jpg_mobile"
                        class="form-control-file {{ $errors->has('imageJpgMobile') ? ' is-invalid' : '' }}"
                        accept="image/jpeg"
                    />
                    @if ($errors->has('imageJpgMobile'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('imageJpgMobile') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="imageWebpDesktop">{{ __('Image WebP (Desktop):') }}</label>
                    <input
                        id="imageWebpDesktop"
                        type="file"
                        name="image_webp_desktop"
                        class="form-control-file {{ $errors->has('imageWebpDesktop') ? ' is-invalid' : '' }}"
                        accept="image/webp"
                    />
                    @if ($errors->has('imageWebpDesktop'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('imageWebpDesktop') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="imageJpgDesktop">{{ __('Image JPEG (Desktop):') }}</label>
                    <input
                        id="imageJpgDesktop"
                        type="file"
                        name="image_jpg_desktop"
                        class="form-control-file {{ $errors->has('imageJpgDesktop') ? ' is-invalid' : '' }}"
                        accept="image/jpeg"
                    />
                    @if ($errors->has('imageJpgDesktop'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('imageJpgDesktop') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="imageJpg">{{ __('Image default (JPG):') }}</label>
                    <input
                        id="imageJpg"
                        type="file"
                        name="image_jpg"
                        class="form-control-file {{ $errors->has('imageJpg') ? ' is-invalid' : '' }}"
                        accept="image/jpeg"
                    />
                    @if ($errors->has('imageJpg'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('imageJpg') }}</strong>
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
                                       value="{{ old('link_url') }}"/>
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
                    <button type="submit" class="btn btn-primary">{{ __('Create Slide') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
