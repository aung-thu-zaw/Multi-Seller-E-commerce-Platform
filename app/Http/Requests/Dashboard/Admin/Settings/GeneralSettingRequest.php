<?php

namespace App\Http\Requests\Dashboard\Admin\Settings;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GeneralSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('general-settings.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'site_name' => ['nullable', 'string'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'company_phone' => ['nullable', 'string'],
            'company_email' => ['nullable', 'email'],
            'support_phone' => ['nullable', 'string'],
            'support_email' => ['nullable', 'email'],
            'address' => ['nullable', 'string', 'max:255'],
            'copyright' => ['nullable', 'string', 'max:255'],
            'facebook_url' => ['nullable', 'url'],
            'twitter_url' => ['nullable', 'url'],
            'instagram_url' => ['nullable', 'url'],
            'linked_in_url' => ['nullable', 'url'],
            'youtube_url' => ['nullable', 'url'],
            'captcha_token' => [new RecaptchaRule()],
        ];

        if ($this->hasFile('header_logo')) {
            $rules['header_logo'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];
        }

        if ($this->hasFile('footer_logo')) {
            $rules['footer_logo'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];
        }

        if ($this->hasFile('favicon')) {
            $rules['favicon'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];
        }

        return $rules;
    }
}
