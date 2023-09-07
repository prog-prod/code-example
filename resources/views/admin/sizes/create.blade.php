@extends('admin.layouts.base')
@section('title', 'Create size')

@section('header')
    <h1>Add Size</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Size</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('admin.sizes.store') }}">
            @csrf
            <div class="card-body">
                <x-form-control attribute="key"/>
                <x-multi-lang-form-control attribute-name="name"/>
                <div class="form-group">
                    <label for="short_form">Value</label>
                    <input type="text" class="form-control @error('value') is-invalid @enderror" id="short_form"
                           name="value" placeholder="Enter value" value="{{ old('value') }}" required>
                    @error('value')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
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
                                        'oldValue' => old('category_id'),
                                      ])
                        </x-adminlte-select2>
                    </div>
                @endif
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
