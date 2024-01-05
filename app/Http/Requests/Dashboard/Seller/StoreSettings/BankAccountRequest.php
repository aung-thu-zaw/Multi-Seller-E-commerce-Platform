<?php

namespace App\Http\Requests\Dashboard\Seller\StoreSettings;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BankAccountRequest extends FormRequest
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
            "account_title" => ["required","string"],
            "account_number" => ["required","string"],
            "bank_name" => ["required","string",Rule::in(['kbz','aya','cb','agd'])],
            "branch_code" => ["nullable"],
            'captcha_token' => [new RecaptchaRule()],
        ];
    }
}
