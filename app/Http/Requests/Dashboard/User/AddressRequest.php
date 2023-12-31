<?php

namespace App\Http\Requests\Dashboard\User;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddressRequest extends FormRequest
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
            "name" => ["required","string","max:255"],
            "phone" => ["required","string","max:255"],
            "email" => ["required","email","max:255"],
            "region" => ["required","string","max:255"],
            "city" => ["required","string","max:255"],
            "township" => ["required","string","max:255"],
            "postal_code" => ["nullable","string","max:255"],
            "address" => ["required","string","max:255"],
            "landmark" => ["nullable","string","max:255"],
            "is_default_billing" => ["nullable","boolean"],
            "is_default_delivery" => ["nullable","boolean"],
            "address_type" => ["required","string",Rule::in(["home","office"])],
            'captcha_token' => [new RecaptchaRule()],
        ];
    }
}
