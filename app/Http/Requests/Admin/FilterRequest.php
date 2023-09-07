<?php

namespace App\Http\Requests\Admin;

use App\Rules\KeyRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        $filter = $this->route('filter'); // get the current category record
        $filterId = $filter ? $filter->id : null;
        return [
            'key' => ["required", "unique:filters,key,$filterId", "max:255", new KeyRule()],
            'name_uk' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'categories' => 'array',
            'categories.*' => 'numeric|exists:categories,id',
            'printCategories' => 'array',
            'printCategories.*' => 'numeric|exists:print_categories,id'
        ];
    }
}
