<?php

namespace App\Http\Requests\Dashboard\Admin\Banners\SliderBanners;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreSliderBannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('slider-banners.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        "url" => ["required","url"],
        "status" => ["required","string",Rule::in(["show","hide"])],
        'image' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1500'],
        "captcha_token"  => [new RecaptchaRule()],
        ];
    }
}
