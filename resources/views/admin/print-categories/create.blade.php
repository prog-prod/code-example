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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Print Category</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{ route('admin.print-categories.store') }}" enctype="multipart/form-data"
              method="POST">
            @csrf
            <div class="card-body">
                <x-form-control attribute="key"/>
                <x-multi-lang-form-control attribute-name="name"/>
                <x-multi-lang-form-control attribute-name="description"
                                           form-control-type="adminlte-text-editor"/>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror"
                           id="image" required>
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
                                        'oldValue' => old('parent_id'),
                                      ])
                        </x-adminlte-select2>
                    </div>
                @endif
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
@endsection
