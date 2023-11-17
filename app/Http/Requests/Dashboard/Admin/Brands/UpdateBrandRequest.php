<?php

namespace App\Http\Requests\Dashboard\Admin\Brands;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('brands.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $brand = $this->route()->parameter('brand');

        $rules = [
            'name' => ['required', 'string', 'max:255', Rule::unique('brands', 'name')->ignore($brand)],
            'status' => ['required', 'string', Rule::in(['active', 'inactive'])],
            'captcha_token' => [new RecaptchaRule()],
        ];

        if ($this->hasFile('logo')) {

            $rules['logo'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];

        } else {

            $rules['logo'] = ['nullable', 'string'];
        }

        return $rules;
    }
}
