<?php

namespace App\Http\Requests\Dashboard\Categories;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            'parent_id' => ['nullable', 'numeric', Rule::exists('categories', 'id')],
            'name' => ['required', 'string', 'max:255', Rule::unique('categories', 'name')],
            'status' => ['required', 'boolean'],
            'captcha_token' => [new RecaptchaRule()],
        ];

        if ($this->hasFile('image')) {
            $rules['image'] = ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'];
        }

        $route = $this->route();
        if ($route && in_array($this->method(), ['POST', 'PUT', 'PATCH'])) {
            $category = $route->parameter('category');
            $rules['name'] = ['required', 'string', 'max:255', Rule::unique('categories', 'name')->ignore($category)];
        }

        return $rules;
    }
}
