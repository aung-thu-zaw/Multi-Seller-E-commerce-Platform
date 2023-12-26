<?php

namespace App\Http\Requests\Ecommerce;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConversationMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            "customer_id" => ["nullable","numeric",Rule::exists("users", "id")],
            "store_id" => ["nullable","numeric",Rule::exists("stores", "id")],
            "message" => ["nullable","string"],
            "reply_to_message_id" => ["nullable","numeric"],
            "captcha_token" => [new RecaptchaRule()],
        ];

        if ($this->hasFile("files")) {
            $rules['files.*'] = ['required','file','mimetypes:image/jpeg,image/png,image/gif,image/webp,image/jpg,image/svg,video/avi,video/mpeg,video/mp4,video/webm'];
        }

        return $rules;
    }
}
