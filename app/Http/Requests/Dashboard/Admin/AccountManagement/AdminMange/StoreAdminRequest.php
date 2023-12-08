<?php

namespace App\Http\Requests\Dashboard\Admin\AccountManagement\AdminMange;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('admin-manage.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "role_id" => ["required","numeric",Rule::exists("roles", "id")],
            "name" => ["required","string","max:255",Rule::unique("users", "name")],
            "email" => ["required","email","lowercase","max:255",Rule::unique("users", "email")],
            "phone" => ["required","string",Rule::unique("users", "phone")],
            "password" => ['required', 'confirmed',Password::default()],
            'avatar' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'],
            'captcha_token' => [new RecaptchaRule()],
        ];
    }
}
