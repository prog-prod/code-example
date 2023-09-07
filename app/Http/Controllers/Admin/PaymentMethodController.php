<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\SmsTemplateRepositoryInterface;
use App\Enums\RequisitesFieldsEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentMethodRequest;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::all();

        return view('admin.payment_methods.index', compact('paymentMethods'));
    }

    public function create(SmsTemplateRepositoryInterface $smsTemplateRepository)
    {
        $smsTemplates = $smsTemplateRepository->getAllSmsTemplates();
        return view('admin.payment_methods.create', compact('smsTemplates'));
    }

    public function store(PaymentMethodRequest $request)
    {
        $validatedData = $request->validated();

        $paymentMethod = new PaymentMethod;
        $paymentMethod->key = $validatedData['key'];
        $requisites = $paymentMethod->requisites ?? [];
        $paymentMethod->sms_template_id = $validatedData['sms_template_id'] === '0' ? null : $validatedData['sms_template_id'];

        foreach (RequisitesFieldsEnum::getValues() as $suffix) {
            if (isset($validatedData['requisites_' . $suffix])) {
                $requisites[$suffix] = $validatedData['requisites_' . $suffix];
            }
        }
        $paymentMethod->requisites = $requisites;
        $paymentMethod->active = $validatedData['active'];
        $paymentMethod->save();

        $paymentMethod->addTranslations($validatedData);

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Payment method created successfully.');
    }

    public function edit(PaymentMethod $paymentMethod, SmsTemplateRepositoryInterface $smsTemplateRepository)
    {
        $smsTemplates = $smsTemplateRepository->getAllSmsTemplates();
        return view('admin.payment_methods.edit', compact('paymentMethod', 'smsTemplates'));
    }

    public function update(PaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        $validatedData = $request->validated();
        $paymentMethod->key = $validatedData['key'];
        $paymentMethod->active = $validatedData['active'];
        $paymentMethod->sms_template_id = $validatedData['sms_template_id'] === '0' ? null : $validatedData['sms_template_id'];
        $requisites = $paymentMethod->requisites ?? [];
        foreach (RequisitesFieldsEnum::getValues() as $suffix) {
            if (isset($validatedData['requisites_' . $suffix])) {
                $requisites[$suffix] = $validatedData['requisites_' . $suffix];
            }
        }
        $paymentMethod->requisites = $requisites;

        $paymentMethod->save();

        $paymentMethod->addTranslations($validatedData);

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Payment method updated successfully.');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Payment method deleted successfully.');
    }
}
