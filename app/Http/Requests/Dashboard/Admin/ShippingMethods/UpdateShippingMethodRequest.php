<?php

namespace App\Http\Requests\Dashboard\Admin\ShippingMethods;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateShippingMethodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('shipping-methods.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $shippingMethod = $this->route()->parameter('shipping_method');

        $rules = [
            'name' => ['required', 'string', 'max:255', Rule::unique('shipping_methods', 'name')->ignore($shippingMethod)],
            'captcha_token' => [new RecaptchaRule()],
        ];

        return $rules;
    }
}
