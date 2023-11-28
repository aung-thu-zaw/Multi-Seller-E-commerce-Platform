<?php

namespace App\Http\Requests\Dashboard\Seller;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $rules = [
            'brand_id' => ['nullable', 'numeric', Rule::exists('brands', 'id')],
            'category_id' => ['required', 'numeric', Rule::exists('categories', 'id')],
            'store_product_category_id' => ['nullable', 'numeric', Rule::exists('store_product_categories', 'id')],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'sku' => ['nullable', 'string', 'max:255'],
            'qty' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'status' => ['required',Rule::in(['draft','pending','approved','rejected'])],
            'discount' => ['nullable', 'numeric'],
            'discount_start_date' => ['nullable', 'date'],
            'discount_end_date' => ['nullable', 'date'],
            'captcha_token' => [new RecaptchaRule()],
        ];


        if ($this->method() === 'POST') {
            $rules['image'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];
        }

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            if ($this->hasFile('image')) {

                $rules['image'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];

            } else {

                $rules['image'] = ['nullable', 'string'];
            }
        }

        return $rules;
    }
}
