<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// This class validates department requests; it does not format JSON responses.
class DepartmentResource extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isHeadTeacher();
    }

    public function rules(): array
    {
        // Only saving a department requires form fields.
        if (! $this->isMethod('POST') && ! $this->isMethod('PUT') && ! $this->isMethod('PATCH')) {
            return [];
        }

        return [
            'name' => [
                'required',
                'string',
                'max:20',
                Rule::unique('departments', 'name')->ignore($this->route('department')),
            ],
            'hod_id' => [
                'nullable',
                'integer',
                Rule::exists('users', 'id')->where('role', User::HOD),
            ],
        ];
    }
}
