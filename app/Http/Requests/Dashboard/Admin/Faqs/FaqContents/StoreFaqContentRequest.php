<?php

namespace App\Http\Requests\Dashboard\Admin\Faqs\FaqContents;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreFaqContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('faq-contents.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'faq_subcategory_id' => ['required', Rule::exists('faq_subcategories', 'id')],
            'question' => ['required', 'string', 'max:255', Rule::unique('faq_contents', 'question')],
            'answer' => ['required', 'string'],
            'captcha_token' => [new RecaptchaRule()],
        ];
    }
}
