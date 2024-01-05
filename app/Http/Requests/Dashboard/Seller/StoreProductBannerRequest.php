<?php

namespace App\Http\Requests\Dashboard\Seller;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductBannerRequest extends FormRequest
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
            'url' => ['required', 'url'],
            'status' => ['required', 'string', Rule::in(['show', 'hide'])],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'],
            'captcha_token' => [new RecaptchaRule()],
        ];

        if ($this->route() && in_array($this->method(), ['PUT', 'PATCH'])) {

            if ($this->hasFile('image')) {

                $rules['image'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];

            } else {

                $rules['image'] = ['nullable', 'string'];
            }
        }


        return $rules;
    }
}
