@extends('admin.layouts.base')
@section('title', 'SMS Templates')
@section('header')
    <h1>SMS Templates</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Sms Templates') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.sms-templates.create') }}"
                               class="btn btn-primary">{{ __('Create') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Key') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('SMS Template') }}</th>
                                <th>{{ __('Created at') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($smsTemplates as $smsTemplate)
                                <tr>
                                    <td>{{ $smsTemplate->id }}</td>
                                    <td>{{ $smsTemplate->key }}</td>
                                    <td>{{ $smsTemplate->name }}</td>
                                    <td>{{ $smsTemplate->template }}</td>
                                    <td>{{ $smsTemplate->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.sms-templates.show', $smsTemplate) }}"
                                           class="btn btn-primary">{{ __('Show') }}</a>
                                        <a href="{{ route('admin.sms-templates.edit', $smsTemplate) }}"
                                           class="btn btn-warning">{{ __('Edit') }}</a>
                                        <form action="{{ route('admin.sms-templates.destroy', $smsTemplate) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
