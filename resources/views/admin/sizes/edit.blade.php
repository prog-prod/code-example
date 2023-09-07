@extends('admin.layouts.base')
@section('title', 'Edit '.$size->name)

@section('header')
    <h1>Edit Size {{$size->name}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Size</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('admin.sizes.update', $size) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <x-form-control attribute="key" :model="$size"/>
                <x-multi-lang-form-control attribute-name="name" :model="$size"/>
                <div class="form-group">
                    <label for="value">Value</label>
                    <input type="text" class="form-control @error('value') is-invalid @enderror" id="value"
                           name="value" placeholder="Enter size short form"
                           value="{{ old('value', $size->value) }}">
                    @error('value')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                @if(count($categories) > 0)
                    <div class="form-group">
                        <x-adminlte-select2 id="sel2Category" placeholder="Select category"
                                            name="category_id" label="Product Category">
                            <option value="0">No category</option>
                            @include('admin.layouts.option_tree', [
                                        'children' => $categories,
                                        'parents' => [],
                                        'oldValue' => old('category_id', $size->category),
                                      ])
                        </x-adminlte-select2>
                    </div>
                @endif
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
