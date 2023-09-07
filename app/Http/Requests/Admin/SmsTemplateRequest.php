<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SmsTemplateRequest extends FormRequest
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
        $item = $this->route('sms_template');
        $smsTemplateId = $item ? $item->id : null;
        return [
            'key' => 'required|unique:sms_templates,key,' . $smsTemplateId . '|string|max:255',
            'template' => 'required|string',
            'name_uk' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
        ];
    }
}
