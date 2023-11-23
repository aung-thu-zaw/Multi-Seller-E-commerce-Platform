<?php

namespace App\Http\Requests\Ecommerce;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogCommentRequest extends FormRequest
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
        return [
            "blog_content_id" => ["required","numeric",Rule::exists("blog_contents", "id")],
            "user_id" => ["required","numeric",Rule::exists("users", "id")],
      
        ];
    }
}
