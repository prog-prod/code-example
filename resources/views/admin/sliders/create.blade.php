@extends('admin.layouts.base')
@section('title', 'Create a slider')
@section('plugins.BootstrapColorpicker', true)

@section('header')
    <h1>Add Slider</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Slider</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('admin.sliders.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter slider name"
                           required>
                </div>
                <div class="form-group">
                    <label for="autoplay">Autoplay</label>
                    <select class="form-control" id="autoplay" name="autoplay">
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="lazyLoad">Lazy Load</label>
                    <input type="text" class="form-control" id="lazyLoad" name="lazyLoad"
                           placeholder="Enter lazy load type" value="progressive" required>
                </div>
                <div class="form-group">
                    <label for="autoplay_speed">Autoplay Speed</label>
                    <input type="text" class="form-control" id="autoplay_speed" name="autoplay_speed"
                           placeholder="Enter autoplay speed">
                </div>
                <div class="form-group">
                    <label for="speed">Speed</label>
                    <input type="text" class="form-control" id="speed" name="speed" placeholder="Enter slider speed"
                           value="100" required>
                </div>
                <div class="form-group">
                    <label for="pause_on_focus">Pause on Focus</label>
                    <select class="form-control" id="pause_on_focus" name="pause_on_focus">
                        <option value="1">Yes</option>
                        <option value="0" selected>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pause_on_hover">Pause on Hover</label>
                    <select class="form-control" id="pause_on_hover" name="pause_on_hover">
                        <option value="1">Yes</option>
                        <option value="0" selected>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="infinite">Infinite</label>
                    <select class="form-control" id="infinite" name="infinite">
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="arrows">Arrows</label>
                    <select class="form-control" id="arrows" name="arrows">
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dots">Dots</label>
                    <select class="form-control" id="dots" name="dots">
                        <option value="1">Yes</option>
                        <option value="0" selected>No</option>
                    </select>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection
