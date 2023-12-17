<?php

namespace App\Http\Requests\Dashboard\Admin\FlashSales;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreFlashSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('flash-sales.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["required","string","max:255",Rule::unique("flash_sales", "name")],
            "start_date" => ["required","date"],
            "end_date" => ["required","date"],
            'captcha_token' => [new RecaptchaRule()],
        ];
    }
}
