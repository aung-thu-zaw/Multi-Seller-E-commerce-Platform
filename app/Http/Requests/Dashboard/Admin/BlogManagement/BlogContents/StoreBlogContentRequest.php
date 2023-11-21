<?php

namespace App\Http\Requests\Dashboard\Admin\BlogManagement\BlogContents;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreBlogContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('blog-contents.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'blog_category_id' => ['required', 'numeric', Rule::exists('blog_categories', 'id')],
            'author_id' => ['required', 'numeric', Rule::exists('users', 'id')],
            'title' => ['required', 'string', 'max:255', Rule::unique('blog_contents', 'title')],
            'status' => ['required', 'string', Rule::in(['draft', 'published'])],
            'thumbnail' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'],
            'content' => ['required', 'string'],
            'captcha_token' => [new RecaptchaRule()],
        ];
    }
}
