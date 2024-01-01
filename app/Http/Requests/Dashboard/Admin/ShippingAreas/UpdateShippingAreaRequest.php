<?php

namespace App\Http\Requests\Dashboard\Admin\ShippingAreas;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateShippingAreaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('shipping-areas.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $shippingArea = $this->route()->parameter('shipping_area');

        $rules = [
            'region_id' => ['required', 'numeric', Rule::exists('regions', 'id')],
            'city_id' => ['required', 'numeric', Rule::exists('cities', 'id')],
            'township_id' => ['required', 'numeric', Rule::exists('townships', 'id')],
            'name' => ['required', 'string', 'max:255', Rule::unique('shipping_areas', 'name')->ignore($shippingArea)],
            'captcha_token' => [new RecaptchaRule()],
        ];

        return $rules;
    }
}
