@extends('adminlte::page')

@section('content_header')
    @if(session()->has('success'))
        <x-adminlte-alert theme="success" title="Success" dismissable>
            {{session('success')}}
        </x-adminlte-alert>
    @endif
    @if(session()->has('error'))
        <x-adminlte-alert theme="danger" title="Error" dismissable>
            {{session('error')}}
        </x-adminlte-alert>
    @endif
    @if($errors->any())
        <x-adminlte-alert theme="warning" title="Warning" dismissable>
            @foreach ($errors->all() as $error)
                {{$error}}
            @endforeach
        </x-adminlte-alert>
    @endif

    @yield('header')
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/css/admin_custom.css')}}">
@endsection
