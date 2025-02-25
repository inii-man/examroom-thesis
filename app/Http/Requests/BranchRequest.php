<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchRequest extends FormRequest
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
            'data.*.branch_name' => 'required|distinct|unique:branches',
            'data.*.branch_type' => 'required|distinct',
        ];

        if (isset($this->branch_id)) {
            $validate['data.*.branch_name'] = [
                'required',
                'distinct',
                Rule::unique('branches')->ignore($this->branch_id, 'branch_id'),
            ];
        }

        return $validate;
    }
    public function messages(): array
    {
        return [
            'data.*.branch_name.required' => 'Branch Name is required',
            'data.*.branch_name.distinct' => 'Branch Name must be unique',
            'data.*.branch_name.unique' => 'Branch Name is already registered',
            'data.*.branch_type.required' => 'Branch Type is required',
            'data.*.branch_type.distinct' => 'Branch Type must be unique',
        ];
    }
}
