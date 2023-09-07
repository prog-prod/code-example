@extends('admin.layouts.base')
@section('title', 'Create Print')
@section('plugins.Select2', true)

@section('header')
    <h1>Create Print</h1>
@stop
@php
    $config_select2 = [
        "allowClear" => true
    ];
@endphp
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Print Image</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.prints.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <x-form-control attribute="key"/>
                <x-multi-lang-form-control attribute-name="name"/>
                <x-multi-lang-form-control attribute-name="description"
                                           form-control-type="adminlte-text-editor"/>
                @if(count($categories) > 0)
                    <div class="form-group">
                        <x-adminlte-select2 id="sel2Category" placeholder="Select category"
                                            name="print_category_id" label="Category"
                                            :config="$config_select2">
                            @include('admin.layouts.option_tree', [
                                        'children' => $categories,
                                        'parents' => [],
                                        'oldValue' => old('print_category_id'),
                                      ])
                        </x-adminlte-select2>
                    </div>
                @endif

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

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
