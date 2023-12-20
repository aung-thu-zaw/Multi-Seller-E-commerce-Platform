<?php

namespace App\Http\Requests\Dashboard\Admin\ProductManage\VariantTypeAndValues;

use Illuminate\Foundation\Http\FormRequest;

class StoreVariantTypeAndValueRequest extends FormRequest
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
            'variant_type' => ['required', 'string'],
            'variant_value' => ['required', 'array'],
        ];
    }
}
