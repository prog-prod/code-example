@extends('admin.layouts.base')
@section('title', "Обновлення даних способу оплати: ".($paymentMethod->name ?? $paymentMethod->key))
@section('plugins.BsCustomFileInput', true)
@section('plugins.BootstrapColorpicker', true)
@section('plugins.Select2', true)

@section('header')
    <h1>Обновлення даних способу оплати: {{$paymentMethod->name ?? $paymentMethod->key}}</h1>
@stop
@php
    $config_select2 = [
        "allowClear" => true
    ];
@endphp
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Payment Method</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.payment-methods.update', $paymentMethod->id) }}" method="POST">
                @csrf
                @method('PUT')
                <x-form-control attribute="key" :model="$paymentMethod"/>
                <x-multi-lang-form-control attribute-name="name" label="Title" :model="$paymentMethod"/>
                <x-multi-lang-form-control attribute-name="description" label="Description" :model="$paymentMethod"/>
                <div class="form-group">
                    <label for="requisites_card" class="col-form-label">Номер карти:</label>
                    <input id="requisites_card" type="text" placeholder="Введіть номер карти..."
                           class="form-control card-number"
                           name="requisites_card"
                           value="{{old('requisites_card', $paymentMethod->requisites[\App\Enums\RequisitesFieldsEnum::CARD->value] ?? '')}}"
                           autocomplete="requisites"
                           autofocus="">
                </div>
                <div class="form-group">
                    <label for="requisites_fop" class="col-form-label">ФОП:</label>
                    <input id="requisites_fop" type="text" placeholder="Введіть імʼя ФОП..."
                           class="form-control fop-name"
                           name="requisites_fop"
                           value="{{old('requisites_fop', $paymentMethod->requisites[\App\Enums\RequisitesFieldsEnum::FOP->value] ?? '')}}"
                           autocomplete="requisites"
                           autofocus="">
                </div>
                <div class="form-group">
                    <label for="requisites_iban" class="col-form-label">IBAN:</label>
                    <input id="requisites_iban" type="text" placeholder="Введіть номер IBAN..."
                           class="form-control iban-number"
                           name="requisites_iban"
                           value="{{old('requisites_iban', $paymentMethod->requisites[\App\Enums\RequisitesFieldsEnum::IBAN->value] ?? '')}}"
                           autocomplete="requisites"
                           autofocus="">
                </div>
                <div class="form-group">
                    <label for="requisites_edrpou" class="col-form-label">код ЄДРПОУ:</label>
                    <input id="requisites_edrpou" type="text" placeholder="Введіть код ЄДРПОУ..."
                           class="form-control edrpou-code"
                           name="requisites_edrpou"
                           value="{{old('requisites_edrpou', $paymentMethod->requisites[\App\Enums\RequisitesFieldsEnum::EDRPOU->value] ?? '')}}"
                           autocomplete="requisites"
                           autofocus="">
                </div>
                <div class="form-group">
                    <label for="requisites_mfo" class="col-form-label">MФО банку:</label>
                    <input id="requisites_mfo" type="text" placeholder="Введіть код МФО..."
                           class="form-control mfo-code"
                           name="requisites_mfo"
                           value="{{old('requisites_mfo', $paymentMethod->requisites[\App\Enums\RequisitesFieldsEnum::MFO->value] ?? '')}}"
                           autocomplete="requisites"
                           autofocus="">
                </div>
                <div class="form-group">
                    <label for="requisites_purpose_of_amount" class="col-form-label">Призначення платежу:</label>
                    <input id="requisites_purpose_of_amount" type="text"
                           placeholder="Введіть текст призначення платежу..."
                           class="form-control "
                           name="requisites_purpose_of_amount"
                           value="{{old('requisites_purpose_of_amount', $paymentMethod->requisites[\App\Enums\RequisitesFieldsEnum::PURPOSE_OF_AMOUNT->value] ?? '')}}"
                           multiple="" autocomplete="requisites" autofocus="">
                    <small>Доступні змінні: "{order_number}" - номер замовлення</small>
                </div>
                <x-adminlte-select2 id="sel2SmsTemplate" label="SMS template"
                                    name="sms_template_id"
                                    :config="array_merge($config_select2,['placeholder' => 'Select sms template'])">
                    <option value="0">No template</option>
                    @foreach($smsTemplates as $smsTemplate)
                        <option
                            value="{{$smsTemplate->id}}" {{ $smsTemplate->id === old('sms_template_id', $paymentMethod->smsTemplate?->id) ? 'selected' : '' }}>{{$smsTemplate->name}}</option>
                    @endforeach
                </x-adminlte-select2>
                <div class="form-group">
                    <label for="active">Active</label>
                    <select class="form-control" id="active"
                            name="active">
                        @foreach(["No", "Yes"] as $key => $value)
                            <option value="{{$key}}"
                                    @if($key == old('active', $paymentMethod->active)) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Payment Method</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script
        src="{{asset('js/cdnjs.cloudflare.com_ajax_libs_jquery.inputmask_5.0.6_jquery.inputmask.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            // Applying the input mask for a typical credit card number
            $('.card-number').inputmask('9999 9999 9999 9999');
            $('.fop-name').inputmask({
                mask: 'ФОП *{1,50} *{1,50} *{1,50}',
                placeholder: '',
                definitions: {
                    '*': {
                        validator: '[A-Za-zА-Яа-яі ]',
                        cardinality: 1,
                    },
                },
                greedy: false,
            });
            $('.iban-number').inputmask('U\\A 99 999999 99999 9999 9999 9999 99');
            $('.mfo-code').inputmask('9{8}');
            $('.edrpou-code').inputmask('9{10}');
        });
    </script>
@endsection
