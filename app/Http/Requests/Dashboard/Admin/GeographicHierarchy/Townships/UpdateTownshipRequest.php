<?php

namespace App\Http\Requests\Dashboard\Admin\GeographicHierarchy\Townships;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateTownshipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('townships.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $township = $this->route()->parameter('township');

        $rules = [
            'city_id' => ['required', 'numeric', Rule::exists('cities', 'id')],
            'name' => ['required', 'string', 'max:255', Rule::unique('townships', 'name')->ignore($township)],
            'captcha_token' => [new RecaptchaRule()],
        ];

        return $rules;
    }
}
