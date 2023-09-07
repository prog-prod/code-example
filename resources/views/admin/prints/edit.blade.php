@extends('admin.layouts.base')
@section('title', 'Edit Print')

@section('header')
    <div class="d-flex">
        <a href="{{ route('admin.prints.show',$print) }}" class="btn btn-link"><i class="fa fa-arrow-left"></i></a>
        <h1>Edit Print {{$print->name}}</h1>
    </div>
@stop
@php
    $config_select2 = [
        "allowClear" => true
    ];
@endphp
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Print Image') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.prints.update', $print->id) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <x-form-control attribute="key" :model="$print"/>
                                <x-multi-lang-form-control attribute-name="name" :model="$print"/>
                                <x-multi-lang-form-control attribute-name="description" :model="$print"
                                                           form-control-type="adminlte-text-editor"/>
                                @if(count($categories) > 0)
                                    <div class="form-group ">
                                        <x-adminlte-select2 id="sel2Category" placeholder="Select category"
                                                            name="print_category_id" label="Category"
                                                            :config="$config_select2">
                                            @include('admin.layouts.option_tree', [
                                                        'children' => $categories,
                                                        'parents' => [],
                                                        'oldValue' => old('print_category_id', $print->print_category_id),
                                                      ])
                                        </x-adminlte-select2>
                                    </div>
                                @endif
                                <div class="form-group ">
                                    <label for="image">{{ __('Image') }}</label>

                                    <div class="custom-file">
                                        <input type="file"
                                               class="custom-file-input @error('image') is-invalid @enderror"
                                               id="image" name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img src="{{Storage::url($print->image)}}" alt="" class="w-100">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
