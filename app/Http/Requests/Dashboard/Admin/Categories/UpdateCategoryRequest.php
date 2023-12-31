<?php

namespace App\Http\Requests\Dashboard\Admin\Categories;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('categories.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $category = $this->route()->parameter('category');

        $rules = [
            'parent_id' => ['nullable', 'numeric', Rule::exists('categories', 'id')],
            'name' => ['required', 'string', 'max:255', Rule::unique('categories', 'name')->ignore($category)],
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
