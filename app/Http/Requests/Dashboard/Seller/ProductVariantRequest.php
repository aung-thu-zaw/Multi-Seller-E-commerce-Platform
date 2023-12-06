<?php

namespace App\Http\Requests\Dashboard\Seller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductVariantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'numeric', Rule::exists('products', 'id')],
            'qty' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'attribute' => ['required', 'numeric',Rule::exists("attributes", "id")],
            'option' => ['required', 'numeric',Rule::exists("options", "id")],
            'discount' => ['nullable', 'numeric'],
            'discount_start_date' => ['nullable', 'date'],
            'discount_end_date' => ['nullable', 'date'],
        ];
    }
}
