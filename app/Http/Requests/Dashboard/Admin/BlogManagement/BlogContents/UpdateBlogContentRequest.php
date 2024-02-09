<?php

namespace App\Http\Requests\Dashboard\Admin\BlogManagement\BlogContents;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateBlogContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('blog-contents.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $blogContent = $this->route()->parameter('blog_content');

        $rules = [
            'blog_category_id' => ['required', 'numeric', Rule::exists('blog_categories', 'id')],
            'title' => ['required', 'string', 'max:255', Rule::unique('blog_contents', 'title')->ignore($blogContent)],
            'status' => ['required', 'string', Rule::in(['draft', 'published'])],
            'content' => ['required', 'string'],
            'tags' => ['nullable', 'array'],
            'captcha_token' => [new RecaptchaRule()],
        ];

        if ($this->hasFile('thumbnail')) {
            $rules['thumbnail'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];
        } else {
            $rules['thumbnail'] = ['nullable', 'string'];
        }

        return $rules;
    }
}
