<?php

namespace App\Http\Requests\Dashboard\Admin\FlashSales;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateFlashSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('flash-sales.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $flashSale = $this->route()->parameter('flash_sale');

        $rules = [
            "name" => ["required","string","max:255",Rule::unique("flash_sales", "name")->ignore($flashSale)],
            "start_date" => ["required","date"],
            "end_date" => ["required","date"],
            'captcha_token' => [new RecaptchaRule()],
        ];

        return $rules;
    }
}
