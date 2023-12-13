<?php

namespace App\Http\Requests\Ecommerce;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BecomeASellerRequest extends FormRequest
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
            'store_name' => ['required', 'string', 'max:255', Rule::unique('stores', 'store_name')],
            'contact_email' => ['required', 'lowercase', 'email', 'max:255', Rule::unique('stores', 'contact_email')],
            'contact_phone' => ['required', 'string', Rule::unique('stores', 'contact_phone')],
            'store_type' => ['nullable', 'string', Rule::in(['personal', 'business'])],
            'address' => ['nullable', 'string','max:255'],
            'description' => ['nullable', 'string'],
            'avatar' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:1500'],
            'captcha_token' => [new RecaptchaRule()],
        ];
    }
}
