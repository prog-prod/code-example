@extends('admin.layouts.base')
@section('title', 'Show Product')
@section('plugins.BootstrapColorpicker', true)
@section('header')
    <h1>Edit Color {{$color->name}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Edit Color</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.colors.update', $color->id) }}">
                @csrf
                @method('PUT')
                <x-form-control attribute="key" :model="$color"/>
                <x-multi-lang-form-control attribute-name="name" :model="$color"/>
                @php
                    $config = [
                        "color" => $color->hex_code,
                        "horizontal" => true,
                    ];
                @endphp
                <x-adminlte-input-color name="hex_code" label="Fill Color" igroup-size="sm" :config="$config" required>
                    <x-slot name="appendSlot">
                        <div class="input-group-text bg-white">
                            <i class="fas fa-lg fa-fill"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-color>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
