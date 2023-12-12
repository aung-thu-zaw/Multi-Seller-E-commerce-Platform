<?php

namespace App\Http\Requests\Dashboard\Admin\Settings;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SeoSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('seo-settings.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'meta_title' => ['required', 'string', 'max:255'],
            'meta_keyword' => ['required', 'string'],
            'meta_description' => ['required', 'string'],
            'captcha_token' => [new RecaptchaRule()],
        ];
    }
}
