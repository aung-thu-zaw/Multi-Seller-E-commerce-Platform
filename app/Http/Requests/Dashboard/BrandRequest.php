<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
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
        $route = $this->route();

        $rules = [
            'name' => ['required', 'string', 'max:255', Rule::unique('brands', 'name')],
            'status' => ['required', 'string', Rule::in(['active','inactive'])],
            'captcha_token' => [new RecaptchaRule()],
        ];

        if ($route && $this->method() === "POST") {
            $rules['logo'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];
        }

        if ($route && in_array($this->method(), ['PUT', 'PATCH'])) {

            $brand = $route->parameter('brand');
            $rules['name'] = ['required', 'string', 'max:255', Rule::unique('brands', 'name')->ignore($brand)];
            $rules['logo'] = $this->hasFile("logo") ? ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'] : ['nullable','string'];
        }

        return $rules;
    }
}
