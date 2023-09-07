@extends('admin.layouts.base')
@section('title', 'Create category')
@section('plugins.BsCustomFileInput', true)
@section('plugins.Select2', true)

@section('header')
    <div class="d-flex">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-link"><i class="fa fa-arrow-left"></i></a>
        <h1>Create category</h1>
    </div>
@stop
@section('content')
    <div class="card">
        <div class="card-header">{{ __('Create Category') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.store') }}"
                  enctype="multipart/form-data">
                @csrf
                <x-form-control attribute="key"/>
                <x-multi-lang-form-control attribute-name="name"/>
                <x-multi-lang-form-control attribute-name="description"
                                           form-control-type="textarea"/>
                <div class="form-group row">
                    <div class="col-md-6">
                        <x-adminlte-select2 id="sel2Category" placeholder="Select parent category"
                                            name="parent_id" label="Parent Category">
                            <option value="0">No parent</option>
                            @include('admin.layouts.option_tree', [
                                        'children' => $categories,
                                        'parents' => [],
                                        'oldValue' => old('parent_id'),
                                      ])
                        </x-adminlte-select2>

                        @error('parent_id')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>
                <div id="image-input" class="form-group">
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
                <div class="form-group  mb-0">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
