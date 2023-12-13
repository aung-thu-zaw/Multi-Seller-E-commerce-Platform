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
            'store_name' => ['required', 'string', 'max:255', Rule::unique('seller_requests', 'store_name')],
            'contact_email' => ['required', 'lowercase', 'email', 'max:255', Rule::unique('seller_requests', 'contact_email')],
            'contact_phone' => ['required', 'string', Rule::unique('seller_requests', 'contact_phone')],
            'store_type' => ['nullable', 'string', Rule::in(['personal', 'business'])],
            'address' => ['nullable', 'string','max:255'],
            'additional_information' => ['nullable', 'string'],
            'captcha_token' => [new RecaptchaRule()],
        ];
    }
}
