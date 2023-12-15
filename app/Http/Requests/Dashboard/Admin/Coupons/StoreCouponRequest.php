<?php

namespace App\Http\Requests\Dashboard\Admin\Coupons;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('coupons.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "code"=>["required","string","max:255",Rule::unique("coupons","code")],
            "type"=>["required","string",Rule::in(['percentage', 'fixed', 'free_shipping'])],
            "value"=>["required","numeric"],
            "usage_limit"=>["required","numeric"],
            "expiry_date"=>["required","date"],
            "status"=>["required","string",Rule::in(['active', 'inactive'])],
            'captcha_token' => [new RecaptchaRule()],
        ];
    }
}
