@extends('admin.layouts.base')
@section('title', 'Create Color')
@section('plugins.BootstrapColorpicker', true)
@section('header')
    <h1>Create Color</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Create Color</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.colors.store') }}">
                @csrf
                <x-form-control attribute="key"/>
                <x-multi-lang-form-control attribute-name="name"/>
                @php
                    $config = [
                        "color" => old('hex_code'),
                        "horizontal" => true,
                    ];
                @endphp
                <x-adminlte-input-color name="hex_code" label="Fill Color" igroup-size="sm" :config="$config">
                    <x-slot name="appendSlot">
                        <div class="input-group-text bg-white">
                            <i class="fas fa-lg fa-fill"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-color>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
