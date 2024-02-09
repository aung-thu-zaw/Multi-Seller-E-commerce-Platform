<?php

namespace App\Http\Requests\Dashboard\Seller\StoreSettings;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

class BusinessInformationRequest extends FormRequest
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
            'business_name' => ['required', 'string'],
            'business_registration_number' => ['required', 'string'],
            'tax_number' => ['required', 'string'],
            'industry' => ['required', 'string'],
            'additional_information' => ['nullable', 'string'],
            'website' => ['required', 'url'],
            'products_or_services' => ['required', 'string'],
            'business_description' => ['nullable', 'string'],
            'contact_email' => ['required', 'email'],
            'contact_phone' => ['required', 'string'],
            'address' => ['required', 'string', 'max:100'],
            'captcha_token' => [new RecaptchaRule()],
        ];

        return $rules;
    }
}
