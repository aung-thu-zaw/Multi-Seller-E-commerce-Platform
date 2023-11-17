<?php

namespace App\Http\Requests\Dashboard\Brands;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBrandRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique('brands', 'name')],
            'status' => ['required', 'string', Rule::in(['active','inactive'])],
            'logo' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'],
            'captcha_token' => [new RecaptchaRule()],
        ];
    }
}
