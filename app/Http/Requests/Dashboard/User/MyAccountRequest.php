<?php

namespace App\Http\Requests\Dashboard\User;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MyAccountRequest extends FormRequest
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
        $user = $this->route()->parameter('user');

        $rules = [
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->ignore($user)],
            'email' => ['required', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user)],
            'phone' => ['nullable', 'string', Rule::unique('users', 'phone')->ignore($user)],
            'gender' => ['nullable', 'string', Rule::in(['male', 'female'])],
            'birthday' => ['nullable', 'date'],
            'captcha_token' => [new RecaptchaRule()],
        ];

        if ($this->hasFile('avatar')) {
            $rules['avatar'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];
        }

        return $rules;
    }
}
