@extends('admin.layouts.base')
@section('title', 'Edit Page'. $page->name)
@section('plugins.Select2', true)

@section('header')
    <h1>Edit Page {{$page->name}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Page {{ $page->title }}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pages.update', $page->id) }}">
                @csrf
                @method('PUT')
                <x-form-control attribute="slug" :model="$page"/>
                <x-multi-lang-form-control attribute-name="title" label="Meta Title" :model="$page"/>
                <x-multi-lang-form-control attribute-name="description" label="Meta Description" :model="$page"
                                           form-control-type="textarea"/>
                <x-multi-lang-form-control attribute-name="keywords" label="Meta Keywords" :model="$page"
                                           form-control-type="textarea"/>


                <div class="list-group" id="sort-list">
                    @foreach($page->sections as $sectionKey => $section)
                        <div class="list-group-item d-flex"
                             data-id="{{old('sections.'.$sectionKey.'.order', $section['order'])}}">
                            <div class="mr-3">
                                <i class="fas fa-arrows-alt handle"></i>
                            </div>
                            <div class="flex-grow-1">
                                <label>{{ucwords(str_replace('_', ' ', $section['key'])) }}</label>
                                <div class="form-group">
                                    <label for="active">Activated</label>
                                    <select class="form-control" id="active"
                                            name="sections[{{ $section['key'] }}][active]">
                                        @foreach(["No", "Yes"] as $key => $value)
                                            <option value="{{$key}}"
                                                    @if($key === old('sections.'.$section['key'].'.active', $section['active'] ?? 0)) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" class="order-input" name="sections[{{ $section['key'] }}][order]"
                                       value="{{old('sections.'.$sectionKey.'.order', $section['order'])}}">

                                <hr>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary mt-4">Save</button>
            </form>
        </div>
    </div>
@endsection


@section('js')
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>

    <script>
        if ($('#sort-list >div').length > 0) {
            var sortable = Sortable.create(document.querySelector('#sort-list'), {
                handle: '.handle',
                animation: 150,
                store: {
                    set: function(sortable) {
                        const sections = Array.from(document.querySelectorAll('#sort-list > div'));
                        $(sections).each(function(key) {
                            $(this).find('.order-input').val(key + 1);
                        });
                    },
                },
            });
        }
    </script>
@endsection
