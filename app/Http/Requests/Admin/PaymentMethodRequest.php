<?php

namespace App\Http\Requests\Admin;

use App\Rules\SmsTemplateIdRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $paymentMethod = $this->route('payment_method');
        $paymentMethodId = $paymentMethod ? $paymentMethod->id : null;
        return [
            'key' => 'required|unique:payment_methods,key,' . $paymentMethodId,
            'sms_template_id' => ['nullable', new SmsTemplateIdRule()],
            'name_uk' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description_uk' => 'nullable|string',
            'description_en' => 'nullable|string',
            'active' => 'integer',
            'requisites_fop' => 'nullable|string|max:255',
            'requisites_edrpou' => 'nullable|string|size:10',
            'requisites_card' => 'nullable|string|size:19',
            'requisites_iban' => 'nullable|string|max:36',
            'requisites_mfo' => 'nullable|string|size:8',
            'requisites_purpose_of_amount' => 'nullable|string',
        ];
    }
}
