<?php

namespace App\Http\Requests\Admin;

use App\Rules\Admin\CurrencyValueRule;
use App\Rules\Admin\GenderValueRule;
use App\Rules\Admin\MainImageRule;
use App\Rules\KeyRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
        $productId = $this->route('product'); // get the current category record
        return [
            'key' => ["required", "string", "max:255", new KeyRule()],
            'slug' => ["required", "unique:products,slug,$productId", "string", "max:255", new KeyRule()],
            'name_uk' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description_uk' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'currency' => ['required', 'string', new CurrencyValueRule()],
            'main' => 'integer',
            'weight' => 'integer',
            'active' => 'integer',
            'main-image' => ['nullable', 'string', new MainImageRule()],
            'category' => 'required|exists:categories,id',
            'images_order' => ['nullable', 'string', new MainImageRule()],
            'color_id' => 'integer',
            'size_id' => 'integer',
            'prints' => 'array',
            'prints.*' => 'exists:print_images,id',
            'sale' => ['nullable', 'numeric', 'min:0'],
            'feature-name_uk' => 'array',
            'feature-name_en' => 'array',
            'feature-name_uk.*' => 'string|max:255',
            'feature-name_en.*' => 'string|max:255',
            'feature-text_uk' => 'array',
            'feature-text_en' => 'array',
            'feature-text_uk.*' => 'string',
            'feature-text_en.*' => 'string',
            'related_products' => 'array',
            'related_products.*' => 'exists:products,id',
            'stock_quantity' => 'nullable|integer|min:0',
            'stock_quantity_product_id' => 'nullable|integer|min:0',
            'gender_id' => ['nullable', new GenderValueRule()],
            'brand_id' => 'nullable|exists:brands,id',
            'new_until' => 'nullable|date',
            'images' => 'array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
