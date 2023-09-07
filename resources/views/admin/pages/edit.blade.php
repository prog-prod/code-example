@extends('admin.layouts.base')
@section('title', 'Update Page '.$page->name)

@section('header')
    <h1>Update Page {{$page->name}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Update Page</h3>
            <div class="card-tools">
                <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary"><i
                        class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pages.update', $page) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <x-form-control attribute="slug" :model="$page"/>
                <div class="form-group">
                    <x-adminlte-select2 id="sel2Layouts" placeholder="Select layout"
                                        name="layout_id" label="Layout">
                        @foreach($layouts as $layout)
                            <option value="{{$layout->id}}">{{$layout->name}}</option>
                        @endforeach
                    </x-adminlte-select2>
                </div>
                <x-multi-lang-form-control attribute-name="title" label="Meta Title" :model="$page"/>
                <x-multi-lang-form-control attribute-name="description" label="Meta Description" :model="$page"
                                           form-control-type="textarea"/>
                <x-multi-lang-form-control attribute-name="keywords" label="Meta Keywords" :model="$page"
                                           form-control-type="textarea"/>
                <x-form-control attribute="sections"
                                form-control-type="textarea" :model="$page"/>
                <button type="submit" class="btn btn-primary mt-4">Update</button>

            </form>
        </div>
    </div>
@endsection
