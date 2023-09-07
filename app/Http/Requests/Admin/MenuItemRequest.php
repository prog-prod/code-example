<?php

namespace App\Http\Requests\Admin;

use App\Rules\KeyRule;
use Illuminate\Foundation\Http\FormRequest;

class MenuItemRequest extends FormRequest
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
     * @return array<string, array|string>
     */
    public function rules(): array
    {
        $item = $this->route('menu_item'); // get the current category record
        $menuItemId = $item ? $item->id : null;
        return [
            'key' => ["required", "unique:menu_items,key,$menuItemId", "max:255", new KeyRule()],
            'name_uk' => 'nullable|max:255',
            'name_en' => 'nullable|max:255',
            'link' => 'nullable|max:255',
            'mega' => 'numeric|in:0,1',
            'image' => 'nullable|image|max:2048',
            'parent_id' => 'nullable|exists:menu_items,id'
        ];
    }
}
