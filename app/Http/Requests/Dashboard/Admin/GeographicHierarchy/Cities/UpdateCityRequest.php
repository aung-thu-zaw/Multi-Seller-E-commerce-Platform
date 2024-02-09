<?php

namespace App\Http\Requests\Dashboard\Admin\GeographicHierarchy\Cities;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateCityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('cities.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $city = $this->route()->parameter('city');

        $rules = [
            'region_id' => ['required', 'numeric', Rule::exists('regions', 'id')],
            'name' => ['required', 'string', 'max:255', Rule::unique('cities', 'name')->ignore($city)],
            'captcha_token' => [new RecaptchaRule()],
        ];

        return $rules;
    }
}
