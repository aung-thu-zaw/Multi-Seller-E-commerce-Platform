<?php

namespace App\Http\Requests\Dashboard\Admin\BlogManagement\BlogCategories;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreBlogCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('blog-categories.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', Rule::unique('blog_categories', 'name')],
            'status' => ['required', 'string', Rule::in(['show', 'hide'])],
            'captcha_token' => [new RecaptchaRule()],
        ];

        if ($this->hasFile('image')) {
            $rules['image'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];
        }

        return $rules;
    }
}
