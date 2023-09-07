@extends('admin.layouts.base')
@section('title', 'Edit Category')
@section('plugins.BsCustomFileInput', true)

@section('header')
    <div class="d-flex">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-link"><i class="fa fa-arrow-left"></i></a>
        <h1>Edit Category {{$category->name}}</h1>
    </div>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Edit Category') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('admin.categories.update', $category) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="key">{{ __('Key') }}</label>
                    <input type="text" class="form-control" id="key" name="key" value="{{ old('key', $category->key) }}"
                           required>
                </div>
                <x-multi-lang-form-control attribute-name="name" :model="$category"/>
                <x-multi-lang-form-control attribute-name="description" :model="$category"
                                           form-control-type="textarea"/>
                <div class="form-group">
                    <label for="parent_id">{{ __('Parent Category') }}</label>
                    <select class="form-control" id="parent_id" name="parent_id">
                        <option value="">{{ __('Select Parent Category') }}</option>
                        @foreach($categories as $cat)
                            <option
                                value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="image-input" class="form-group">
                    @if($category->image)
                        <img src="{{ is_url($category->image) ? $category->image : Storage::url($category->image)}}"
                             alt="" width="100px">
                    @endif
                    <x-adminlte-input-file name="image"
                                           label="Image (Optional)"
                    >
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
            </div>
        </form>
    </div>
@endsection
