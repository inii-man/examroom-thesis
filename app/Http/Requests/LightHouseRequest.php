<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LightHouseRequest extends FormRequest
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
            'light_house_name' => 'required|unique:light_houses',
            'light_house_type' => 'required',
            'light_house_address' => 'required',
            'light_house_structure' => 'required',            
        ];

        if (isset($this->light_house_id)) {
            $validate['light_house_name'] = [
                'required',
                Rule::unique('light_houses')->ignore($this->light_house_id, 'light_house_id'),
            ];
        }

        return $validate;
    }
    public function messages(): array
    {
        return [
            'tower_name.required' => 'Tower Name is required',
            'tower_name.unique' => 'Tower Name is already registered',
            'tower_type.required' => 'Tower Type is required',
            'tower_address.required' => 'Tower Address is required',
            'tower_structure.required' => 'Tower Structure is required',
        ];
    }
}
