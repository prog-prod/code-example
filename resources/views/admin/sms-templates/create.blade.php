@extends('admin.layouts.base')
@section('title', 'Create Sms Template')

@section('header')
    <h1>Create Sms Template</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Create Sms Template') }}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.sms-templates.store') }}">
                @csrf
                <x-form-control attribute="key"/>
                <x-multi-lang-form-control attribute-name="name" label="Title"/>
                <div class="form-group">
                    <label for="template" class="col-form-label">SMS Template:</label>
                    <textarea id="template" type="text" placeholder="Шаблон смс..."
                              class="form-control"
                              name="template"
                              autocomplete="template"
                              rows="6"
                              required
                              autofocus="">{{old('template')}}</textarea>
                    <small>
                        <a href="#!" id="translit_button" data-text-translit="Трансліт"
                           data-text-detranslit="Детрансліт">Трансліт</a>
                    </small>
                    <small class="float-right my-2">Доступні змінні: {!! $smsParams !!}</small>
                </div>
                <button type="submit" class="btn btn-primary mt-3">{{ __('Save') }}</button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/sms-text-translit.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#translit_button').click(function(e) {
                e.preventDefault();
                translit('template', 'template');
                $('#template').trigger('keyup');
            });
        });
    </script>
@endsection
