<?php

namespace App\Http\Requests\Dashboard\Admin\Faqs\FaqCategories;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateFaqCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('faq-categories.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $faqCategory = $this->route()->parameter('faq_category');

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('faq_categories', 'name')->ignore($faqCategory)],
            'captcha_token' => [new RecaptchaRule()],
        ];
    }
}
