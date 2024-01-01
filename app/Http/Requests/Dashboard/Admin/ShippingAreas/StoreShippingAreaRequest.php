<?php

namespace App\Http\Requests\Dashboard\Admin\ShippingAreas;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreShippingAreaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('shipping-areas.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'region_id' => ['required', 'numeric', Rule::exists('regions', 'id')],
            'city_id' => ['required', 'numeric', Rule::exists('cities', 'id')],
            'township_id' => ['required', 'numeric', Rule::exists('townships', 'id')],
            'name' => ['required', 'string', 'max:255', Rule::unique('shipping_areas', 'name')],
            'captcha_token' => [new RecaptchaRule()],
        ];
    }
}
