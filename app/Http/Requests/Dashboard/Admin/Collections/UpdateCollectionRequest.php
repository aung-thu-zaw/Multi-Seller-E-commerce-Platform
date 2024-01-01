<?php

namespace App\Http\Requests\Dashboard\Admin\Collections;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateCollectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('collections.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $collection = $this->route()->parameter('collection');

        $rules = [
            'name' => ['required', 'string', 'max:255', Rule::unique('collections', 'name')->ignore($collection)],
            'description' => ['required', 'string'],
            'status' => ['required', 'string', Rule::in(['show', 'hide'])],
            'captcha_token' => [new RecaptchaRule()],
        ];

        return $rules;
    }
}
