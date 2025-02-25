<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
        $validate = [
            'name' => 'required|unique:roles',
        ];

        if (isset($this->id)) {
            $validate['name'] = [
                'required',
                Rule::unique('roles')->ignore($this->id),
            ];
        }

        return $validate;
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Role name is required',
            'name.unique' => 'Role name is already registered',
        ];
    }
}
