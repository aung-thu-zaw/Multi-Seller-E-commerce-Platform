<?php

namespace App\Http\Requests\Dashboard\Admin\AccountManagement\AdminMange;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('admin-manage.edit');
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
            "role_id" => ["required","numeric",Rule::exists("roles", "id")],
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->ignore($user)],
            'email' => ['required', 'email', 'lowercase', 'max:255', Rule::unique('users', 'email')->ignore($user)],
            'phone' => ['required', 'string', Rule::unique('users', 'phone')->ignore($user)],
            'password' => ['nullable'],
            'captcha_token' => [new RecaptchaRule()],
        ];

        if ($this->hasFile('avatar')) {
            $rules['avatar'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];
        } else {
            $rules['avatar'] = ['nullable', 'string'];
        }

        return $rules;
    }
}
