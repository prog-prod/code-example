@extends('admin.layouts.base')
@section('title', 'Layouts')
@section('plugins.BsCustomFileInput', true)
@section('plugins.BootstrapColorpicker', true)

@section('header')
    <h1>Update Layout {{$layout->name}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Update Layout') }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.layouts.update', $layout) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <x-form-control attribute="key" :model="$layout"/>
                <x-multi-lang-form-control attribute-name="name" :model="$layout"/>
                <x-multi-lang-form-control attribute-name="top_header_text" :model="$layout"/>
                <x-multi-lang-form-control attribute-name="address" :model="$layout" form-control-type="textarea"/>
                @if($layout->header_logo)
                    <img
                        src="{{ is_url($layout->header_logo) ? $layout->header_logo : Storage::url($layout->header_logo)}}"
                        alt="" width="100px">
                @endif
                <x-adminlte-input-file name="header_logo"
                                       label="Header logo"
                >
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
                @if($layout->footer_logo)
                    <img src="{{ is_url($layout->footer_logo) ? $layout->image : Storage::url($layout->footer_logo)}}"
                         alt="" width="100px">
                @endif
                <x-adminlte-input-file name="footer_logo"
                                       label="Footer logo"
                >
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
                <div class="form-group">
                    <label for="top_ads_status">Top ads status</label>
                    <select class="form-control" id="top_ads_status"
                            name="top_ads_status">
                        @foreach(["Off","On"] as $key => $value)
                            <option value="{{$key}}"
                                    @if($key == old('top_ads_status', $layout->top_ads_status)) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    @php
                        $config = [
                            "color" => old('top_ads_bg_color', $layout->top_ads_bg_color),
                            "horizontal" => true,
                        ];
                    @endphp
                    <x-adminlte-input-color name="top_ads_bg_color" label="Top ads bg color" igroup-size="sm"
                                            :config="$config">
                        <x-slot name="appendSlot">
                            <div class="input-group-text bg-white">
                                <i class="fas fa-lg fa-fill"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-color>
                </div>
                <div class="form-group">
                    @if($layout->top_ads_image)
                        <img
                            src="{{ is_url($layout->top_ads_image) ? $layout->top_ads_image : Storage::url($layout->top_ads_image)}}"
                            class="top_ads_bg_img"
                            alt="">
                    @endif
                    <x-adminlte-input-file id="top_ads_image"
                                           name="top_ads_image"
                                           label="Upload top ads bg image"
                                           placeholder="Choose bg image...">
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-file-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                </div>
                <x-form-control attribute="top_ads_link" :model="$layout"/>
                <x-form-control attribute="phones" :model="$layout"/>
                <x-form-control attribute="emails" :model="$layout"/>

                <button type="submit" class="btn btn-primary">{{ __('Update Layout') }}</button>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .top_ads_bg_img {
            max-width: 690px;
            width: 100%;
        }
    </style>
@endsection
