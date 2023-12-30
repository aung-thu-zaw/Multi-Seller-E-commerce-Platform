<?php

namespace App\Http\Requests\Dashboard\Admin\ShippingRates;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateShippingRateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('shipping-rates.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
              "shipping_area_id" => ["required","numeric",Rule::exists("shipping_areas", "id")],
              "shipping_method_id" => ["required","numeric",Rule::exists("shipping_methods", "id")],
              "min_order_total" => ["nullable","numeric"],
              'max_order_total' => ['nullable', 'numeric'],
              'rate' => ['required', 'numeric'],
              'captcha_token' => [new RecaptchaRule()],
          ];
    }
}
