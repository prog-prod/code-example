@extends('admin.layouts.base')
@section('title', 'Edit brand')

@section('header')
    <h1>Edit brand</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Brand</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('admin.brands.update', $brand->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="key">Key</label>
                            <input type="text" class="form-control" id="key" name="key" placeholder="Enter brand key"
                                   value="{{ old('key',$brand->key) }}" required>
                        </div>
                        <x-multi-lang-form-control attribute-name="name" :model="$brand"/>
                        <x-multi-lang-form-control attribute-name="description" :model="$brand"
                                                   form-control-type="textarea"/>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Brand</button>
                        <a href="{{ route('admin.brands.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
