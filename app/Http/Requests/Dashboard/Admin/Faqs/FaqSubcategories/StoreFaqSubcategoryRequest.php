<?php

namespace App\Http\Requests\Dashboard\Admin\Faqs\FaqSubcategories;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreFaqSubcategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('faq-subcategories.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'icon' => ['nullable', 'string'],
            'faq_category_id' => ['required', Rule::exists('faq_categories', 'id')],
            'name' => ['required', 'string', 'max:255', Rule::unique('faq_subcategories', 'name')],
            'captcha_token' => ['required', new RecaptchaRule()],
        ];
    }
}
