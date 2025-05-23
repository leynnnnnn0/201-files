<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
        return [
            'id_number' => ['required', 'unique:employees,id_number,' . $this->employee->id],
            'first_name' => ['required'],
            'middle_name' => ['nullable'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'unique:employees,email,' . $this->employee->id],
            'phone_number' => ['required'],
            'position' => ['required'],
            'employment_classification' => ['required'],
            'office_colleges' => ['required'],
            'philhealth_id' => ['nullable'],
            'pag_ibig_id' => ['nullable'],
            'tin_id' => ['nullable'],
            'gsis_id' => ['nullable'],
            'address' => ['required'],
            'status' => ['required'],
            'sex' => ['required'],
            'removed_documents' => ['nullable'],
            'image' => ['nullable']
        ];
    }
}
