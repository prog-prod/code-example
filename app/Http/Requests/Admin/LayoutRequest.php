<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LayoutRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'key' => 'required|string|max:255',
            'name_uk' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'top_header_text_uk' => 'nullable|string|max:255',
            'top_header_text_en' => 'nullable|string|max:255',
            'address_uk' => 'nullable|string|max:1000',
            'address_en' => 'nullable|string|max:1000',
            'header_logo' => 'nullable|image|max:2048',
            'footer_logo' => 'nullable|image|max:2048',
            'top_ads_status' => 'boolean|required',
            'top_ads_image' => 'nullable|image|max:2048',
            'top_ads_link' => 'nullable|string|max:255',
            'top_ads_bg_color' => 'nullable|string|max:255',
            'phones' => 'nullable|string|max:2000',
            'emails' => 'nullable|string|max:2000',
        ];
    }
}
