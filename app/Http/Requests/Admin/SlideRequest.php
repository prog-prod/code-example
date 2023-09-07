<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
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
            'slider_id' => 'required|exists:sliders,id',
            'link_url' => 'nullable|string|max:256',
            'title_uk' => 'nullable|string|max:256',
            'title_en' => 'nullable|string|max:256',
            'image_webp_mobile' => 'nullable|image|max:2048',
            'image_jpg_mobile' => 'nullable|image|max:2048',
            'image_webp_desktop' => 'nullable|image|max:2048',
            'image_jpg_desktop' => 'nullable|image|max:2048',
            'image_jpg' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
        ];
    }
}
