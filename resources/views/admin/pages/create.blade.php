@extends('admin.layouts.base')
@section('title', 'Create Page')

@section('header')
    <h1>Create Page</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Page</h3>
            <div class="card-tools">
                <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary"><i
                        class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pages.store') }}" enctype="multipart/form-data">
                @csrf
                <x-form-control attribute="slug"/>
                <div class="form-group">
                    <x-adminlte-select2 id="sel2Layouts" placeholder="Select layout"
                                        name="layout_id" label="Layout">
                        @foreach($layouts as $layout)
                            <option value="{{$layout->id}}">{{$layout->name}}</option>
                        @endforeach
                    </x-adminlte-select2>
                </div>
                <x-multi-lang-form-control attribute-name="title" label="Meta Title"/>
                <x-multi-lang-form-control attribute-name="description" label="Meta Description"
                                           form-control-type="textarea"/>
                <x-multi-lang-form-control attribute-name="keywords" label="Meta Keywords"
                                           form-control-type="textarea"/>
                <x-form-control attribute="sections"
                                form-control-type="textarea" value="[]"/>

                <button type="submit" class="btn btn-primary mt-4">Save</button>

            </form>
        </div>
    </div>
@endsection
