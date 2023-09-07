@extends('admin.layouts.base')
@section('title', 'Print Category '. $printCategory->name)
@section('header')
    <h1>Print Category {{$printCategory->name}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Print Category {{$printCategory->name}}</h4>
        </div>
        <div class="card-body">
            <ul>
                <li><b>Image: </b> <img src="{{Storage::url($printCategory->image)}}" alt="" width="150px"></li>
                <li><b>Key: </b> {{$printCategory->key}}</li>
                <li><b>Name: </b> {{$printCategory->name}}</li>
                <li>
                    <b>Prints: </b>
                    <ul>
                        @forelse($printCategory->prints as $print)
                            <li>
                                <img src="{{Storage::url($print->image)}}" alt="" width="50px" height="50px">
                                <a href="{{route('admin.prints.show', $print)}}">{{$print->name}}</a>
                            </li>
                        @empty
                            <li>No prints</li>
                        @endforelse
                    </ul>
                </li>
            </ul>
        </div>
    </div>
@endsection
