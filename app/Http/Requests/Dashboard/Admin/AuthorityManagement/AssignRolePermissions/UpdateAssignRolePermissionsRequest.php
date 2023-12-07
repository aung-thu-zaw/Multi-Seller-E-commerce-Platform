<?php

namespace App\Http\Requests\Dashboard\Admin\AuthorityManagement\AssignRolePermissions;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateAssignRolePermissionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('assign-role-permissions.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role_id' => ['required', 'numeric', Rule::exists('roles', 'id')],
            'permission_id' => ['required', 'array', Rule::exists('permissions', 'id')],
            'captcha_token' => [new RecaptchaRule()],
        ];
    }
}
