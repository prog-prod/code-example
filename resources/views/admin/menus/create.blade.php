@extends('admin.layouts.base')
@section('title', 'Create Menu')

@section('header')
    <div class="d-flex">
        <a href="{{ route('admin.menus.index') }}" class="btn btn-link"><i class="fa fa-arrow-left"></i></a>
        <h1>Create Menu</h1>
    </div>
@stop
@section('content')
    <h1>Create Menu</h1>
    <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control-file">
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
