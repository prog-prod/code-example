@extends('admin.layouts.base')
@section('title', 'Sms template: '. $smsTemplate->name)
@section('header')
    <h1>Sms template #{{$smsTemplate->name}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sms template #{{$smsTemplate->name}}</h3>
            <h3 class="card-tools">
                <a href="{{ route('admin.sms-templates.index') }}"
                   class="btn btn-secondary"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
                <a href="{{ route('admin.sms-templates.edit', $smsTemplate) }}"
                   class="btn btn-warning">{{ __('Edit') }}</a>
                <form action="{{ route('admin.sms-templates.destroy', $smsTemplate) }}" method="POST"
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </form>
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>{{ __('ID') }}:</strong> {{ $smsTemplate->id }}</p>
                    <p><strong>{{ __('Key') }}:</strong> {{ $smsTemplate->key }}</p>
                    <p><strong>{{ __('Name') }}:</strong> {{ $smsTemplate->name }}</p>
                    <div class="mb-2">
                        <strong>{{ __('Template') }}:</strong>
                        <div>{{ $smsTemplate->template }}</div>
                    </div>
                    <p><strong>{{ __('Created At') }}:</strong> {{ $smsTemplate->created_at }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
