<?php

namespace App\Http\Requests\Dashboard\Admin\RatingManagement\AutomatedFilterWords;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdatedAutomatedFilterWordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('automated-filter-words.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $automatedFilterWord = $this->route()->parameter('automated_filter_word');

        return [
            "word" => ["required","string",Rule::unique("automated_filter_words", "word")->ignore($automatedFilterWord)],
            'captcha_token' => [new RecaptchaRule()],
        ];
    }
}
