<?php

namespace App\Http\Requests\Dashboard\Seller;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductCategoryRequest extends FormRequest
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
            'store_id' => ["required","numeric",Rule::exists("stores", "id")],
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', Rule::in(['show', 'hide'])],
            'captcha_token' => [new RecaptchaRule()],
        ];
    }
}
