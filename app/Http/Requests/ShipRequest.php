<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShipRequest extends FormRequest
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
            'ship_name' => 'required|unique:ships',
            'ship_type' => 'required',
        ];

        if (isset($this->ship_id)) {
            $validate['ship_name'] = [
                'required',
                Rule::unique('ships')->ignore($this->ship_id, 'ship_id'),
            ];
        }

        return $validate;
    }
    public function messages(): array
    {
        return [
            'ship_name.required' => 'Ship Name is required',
            'ship_name.unique' => 'Ship Name is already registered',
            'ship_type.required' => 'Ship Type is required',
        ];
    }
}
