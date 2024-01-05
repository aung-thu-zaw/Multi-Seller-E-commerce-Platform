<?php

namespace App\Http\Requests\Dashboard\Seller\StoreSettings;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInformationRequest extends FormRequest
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
        $store = $this->route()->parameter('store_id');

        $rules = [
            "store_name" => ["required","string",Rule::unique("stores", "store_name")->ignore($store)],
            "description" => ["nullable","string"],
            "contact_email" => ["required","email",Rule::unique("stores", "contact_email")->ignore($store)],
            "contact_phone" => ["required","string",Rule::unique("stores", "contact_phone")->ignore($store)],
            "address" => ["required","string","max:100"],
            'captcha_token' => [new RecaptchaRule()],
        ];

        if ($this->hasFile('avatar')) {
            $rules['avatar'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];
        } else {
            $rules['avatar'] = ['nullable', 'string'];
        }

        if ($this->hasFile('cover')) {
            $rules['cover'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];
        } else {
            $rules['cover'] = ['nullable', 'string'];
        }

        return $rules;
    }
}
