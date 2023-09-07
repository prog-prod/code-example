@extends('admin.layouts.base')
@section('title', 'Create a brand')

@section('header')
    <h1>Create brand</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Brand</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('admin.brands.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="key">Key</label>
                    <input type="text" class="form-control" id="key" name="key" placeholder="Enter brand key" required>
                </div>
                <x-multi-lang-form-control attribute-name="name"/>
                <x-multi-lang-form-control attribute-name="description" form-control-type="textarea"/>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-default">Cancel</a>
            </div>
        </form>
    </div>
@endsection
