@extends('admin.layouts.base')
@section('title', 'Layouts')
@section('plugins.BsCustomFileInput', true)
@section('plugins.BootstrapColorpicker', true)

@section('header')
    <h1>Layouts</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Create Layout') }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.layouts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <x-form-control attribute="key"/>
                <x-multi-lang-form-control attribute-name="name"/>
                <x-multi-lang-form-control attribute-name="top_header_text"/>
                <x-multi-lang-form-control attribute-name="address" form-control-type="textarea"/>

                <x-adminlte-input-file name="header_logo"
                                       label="Header logo"
                >
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>

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
                                    @if($key == old('top_ads_status')) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    @php
                        $config = [
                            "color" => old('top_ads_bg_color'),
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
                <x-form-control attribute="top_ads_link"/>
                <x-form-control attribute="phones"/>
                <x-form-control attribute="emails"/>

                <button type="submit" class="btn btn-primary">{{ __('Create Layout') }}</button>
            </form>
        </div>
    </div>
@endsection
