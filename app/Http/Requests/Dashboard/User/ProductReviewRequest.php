<?php

namespace App\Http\Requests\Dashboard\User;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductReviewRequest extends FormRequest
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
            'comment' => ['required', 'string'],
            'rating' => ['required', 'numeric'],
            'captcha_token' => [new RecaptchaRule()],
        ];

        if ($this->hasFile('images')) {
            $rules['images.*'] = ['required', 'image', 'mimes:png,jpg,jpeg', 'max:1500'];
        }

        return $rules;
    }
}
