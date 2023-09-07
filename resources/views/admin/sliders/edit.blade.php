@extends('admin.layouts.base')
@section('title', 'Edit '.$slider->name)
@section('plugins.BootstrapColorpicker', true)
@section('header')
    <h1>Edit Slider {{$slider->name}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Slider</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('admin.sliders.update', $slider) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{old('name', $slider->name)}}" id="name" name="name"
                           placeholder="Enter slider name"
                           required>
                </div>
                <div class="form-group">
                    <label for="autoplay">Autoplay</label>
                    <select class="form-control" id="autoplay" name="autoplay">
                        @foreach(["No","Yes"] as $key => $value)
                            <option value="{{$key}}"
                                    @if(old('autoplay', $slider->autoplay) === $key) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="lazyLoad">Lazy Load</label>
                    <input type="text" class="form-control" id="lazyLoad" name="lazyLoad"
                           placeholder="Enter lazy load type" value="{{old('lazyLoad',$slider->lazyLoad)}}" required>
                </div>
                <div class="form-group">
                    <label for="autoplay_speed">Autoplay Speed</label>
                    <input type="text" class="form-control" id="autoplay_speed"
                           value="{{old('autoplay_speed', $slider->autoplay_speed)}}" name="autoplay_speed"
                           placeholder="Enter autoplay speed">
                </div>
                <div class="form-group">
                    <label for="speed">Speed</label>
                    <input type="text" class="form-control" id="speed" name="speed" placeholder="Enter slider speed"
                           value="{{ old('speed', $slider->speed) }}" required>
                </div>
                <div class="form-group">
                    <label for="pause_on_focus">Pause on Focus</label>
                    <select class="form-control" id="pause_on_focus" name="pause_on_focus">
                        @foreach(["No","Yes"] as $key => $value)
                            <option value="{{$key}}"
                                    @if(old('pause_on_focus', $slider->pause_on_focus) === $key) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="pause_on_hover">Pause on Hover</label>
                    <select class="form-control" id="pause_on_hover" name="pause_on_hover">
                        @foreach(["No","Yes"] as $key => $value)
                            <option value="{{$key}}"
                                    @if(old('pause_on_hover', $slider->pause_on_hover) === $key) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="infinite">Infinite</label>
                    <select class="form-control" id="infinite" name="infinite">
                        @foreach(["No","Yes"] as $key => $value)
                            <option value="{{$key}}"
                                    @if(old('infinite', $slider->infinite) === $key) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="arrows">Arrows</label>
                    <select class="form-control" id="arrows" name="arrows">
                        @foreach(["No","Yes"] as $key => $value)
                            <option value="{{$key}}"
                                    @if(old('arrows', $slider->arrows) === $key) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="dots">Dots</label>
                    <select class="form-control" id="dots" name="dots">
                        @foreach(["No","Yes"] as $key => $value)
                            <option value="{{$key}}"
                                    @if(old('dots', $slider->dots) === $key) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
