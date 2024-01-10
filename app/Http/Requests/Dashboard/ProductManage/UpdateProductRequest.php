<?php

namespace App\Http\Requests\Dashboard\ProductManage;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'store_id' => ['nullable', 'numeric', Rule::exists('stores', 'id')],
            'brand_id' => ['nullable', 'numeric', Rule::exists('brands', 'id')],
            'category_id' => ['required', 'numeric', Rule::exists('categories', 'id')],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'offer_price' => ['nullable', 'numeric'],
            'offer_price_start_date' => ['nullable', 'date'],
            'offer_price_end_date' => ['nullable', 'date'],
            'warranty_type' => ['nullable', 'string'],
            'warranty_period' => ['nullable', 'string'],
            'warranty_policy' => ['nullable', 'string'],
            'return_day' => ['nullable', 'string'],
            'return_policy' => ['nullable', 'string'],
            'captcha_token' => [new RecaptchaRule()],
        ];

        if ($this->variants) {
            $rules['qty'] = ['nullable', 'numeric'];
            $rules['price'] = ['nullable', 'numeric'];
            $rules['variants'] = ['required', 'array'];

        } else {

            $rules['qty'] = ['required', 'numeric'];
            $rules['price'] = ['required', 'numeric'];
            $rules['variants'] = ['nullable', 'array'];
        }


        if ($this->hasFile('image')) {

            $rules['image'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];

        } else {

            $rules['image'] = ['nullable', 'string'];
        }

        if ($this->images) {

            $rules['images.*'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];

        } else {

            $rules['images.*'] = ['nullable'];
        }

        return $rules;
    }
}
