<?php

namespace App\Http\Requests\Dashboard\Admin\GeographicHierarchy\Regions;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateRegionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('regions.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $region = $this->route()->parameter('region');

        $rules = [
            'name' => ['required', 'string', 'max:255', Rule::unique('regions', 'name')->ignore($region)],
            'captcha_token' => [new RecaptchaRule()],
        ];

        return $rules;
    }
}
