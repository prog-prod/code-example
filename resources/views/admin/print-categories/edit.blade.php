@extends('admin.layouts.base')
@section('title', 'Print Categories')
@section('plugins.Select2', true)

@section('header')
    <h1>Print Categories</h1>
@stop
@php
    $config_select2 = [
        "allowClear" => true
    ];
@endphp
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Print Category</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.print-categories.update', $printCategory) }}"
                          enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <x-form-control attribute="key" :model="$printCategory"/>
                        <x-multi-lang-form-control attribute-name="name" :model="$printCategory"/>
                        <x-multi-lang-form-control attribute-name="description" :model="$printCategory"
                                                   form-control-type="adminlte-text-editor"/>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image"
                                   class="form-control-file @error('image') is-invalid @enderror"
                                   id="image">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        @if(count($printCategories) > 0)
                            <div class="form-group ">
                                <x-adminlte-select2 id="sel2Category" placeholder="Select parent category"
                                                    name="parent_id" label="Parent Category"
                                                    :config="$config_select2">
                                    <option value="0">No parent</option>
                                    @include('admin.layouts.option_tree', [
                                                'children' => $printCategories,
                                                'parents' => [],
                                                'oldValue' => old('parent_id', $printCategory->parent_id),
                                              ])
                                </x-adminlte-select2>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Update Print Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
