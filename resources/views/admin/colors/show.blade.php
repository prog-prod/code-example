@extends('admin.layouts.base')
@section('title', 'Show Product')
@section('plugins.BootstrapColorpicker', true)
@section('header')
    <h1>Color {{$color->name}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h1>{{ $color->name }}</h1>
        </div>
        <div class="card-body">
            {{-- SM size with custom config --}}
            @php
                $config = [
                    "color" => $color->hex_code,
                    "horizontal" => true,
                ];
            @endphp
            <p>{{ $color->transUA('name') }}</p>
            <p>{{ $color->transEN('name') }}</p>

            <x-adminlte-input-color name="icSizeSm" readonly label="Fill Color" igroup-size="sm" :config="$config">
                <x-slot name="appendSlot">
                    <div class="input-group-text bg-white">
                        <i class="fas fa-lg fa-fill"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-color>
            <div>
                <b>Products:</b>
                <ul>
                    @forelse($color->products as $product)
                        <li><a href="{{route('admin.products.show', $product)}}">{{$product->name}}</a></li>
                    @empty
                        <li>No products</li>
                    @endforelse
                </ul>
            </div>

        </div>
    </div>
@endsection
