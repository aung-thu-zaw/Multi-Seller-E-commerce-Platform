<?php

namespace App\Http\Requests\Dashboard\Admin\ProductManage\Products;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('products.edit');
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
            'seller_id' => ['required', 'numeric', Rule::exists('users', 'id')],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'qty' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'offer_price' => ['nullable', 'numeric'],
            'offer_price_start_date' => ['nullable', 'date'],
            'offer_price_end_date' => ['nullable', 'date'],
            'warranty_type' => ['nullable', 'string'],
            'warranty_period' => ['nullable', 'string'],
            'warranty_policy' => ['nullable', 'string'],
            'return_day' => ['nullable', 'string'],
            'return_policy' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['draft', 'pending', 'approved', 'rejected'])],
            'captcha_token' => [new RecaptchaRule()],
        ];


        if ($this->hasFile('image')) {

            $rules['image'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];

        } else {

            $rules['image'] = ['nullable', 'string'];
        }


        return $rules;

    }
}
