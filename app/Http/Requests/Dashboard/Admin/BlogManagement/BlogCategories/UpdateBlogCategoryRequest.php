<?php

namespace App\Http\Requests\Dashboard\Admin\BlogManagement\BlogCategories;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateBlogCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('blog-categories.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $blogCategory = $this->route()->parameter('blog_category');

        $rules = [
            'name' => ['required', 'string', 'max:255', Rule::unique('categories', 'name')->ignore($blogCategory)],
            'status' => ['required', 'string', Rule::in(['show', 'hide'])],
            'captcha_token' => [new RecaptchaRule()],
        ];

        if ($this->hasFile('image')) {

            $rules['image'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];

        } else {

            $rules['image'] = ['nullable', 'string'];
        }

        return $rules;
    }
}
