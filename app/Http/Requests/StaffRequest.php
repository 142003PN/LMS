<?php

namespace App\Http\Requests;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        $staff = $this->route('staff');

        if ($this->user()->canManageStaff()) {
            return true;
        }

        if ($staff === null) {
            return false;
        }

        return $this->user()->id === $staff->user_id;
    }

    public function rules(): array
    {
        $staff = $this->route('staff');

        $rules = [
            'dept_id' => [
                Rule::requiredIf($this->isMethod('POST')),
                'nullable',
                'uuid',
                Rule::exists('departments', 'id'),
            ],
            'nrc' => [
                'required',
                'string',
                'max:255',
                Rule::unique('staff', 'nrc')->ignore($staff?->id),
            ],
        ];

        if ($this->isMethod('POST')) {
            $rules = array_merge($rules, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
                'phone_number' => ['required', 'string', 'max:255', Rule::unique('users', 'phone_number')],
                'role' => ['required', 'string', Rule::in([User::TEACHER, User::HOD, User::DEPUTY_HEAD_TEACHER])],
                'password' => ['required', 'string', 'min:8'],
            ]);
        }

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules = array_merge($rules, [
                'first_name' => ['sometimes', 'required', 'string', 'max:255'],
                'last_name' => ['sometimes', 'required', 'string', 'max:255'],
                'email' => ['sometimes', 'required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->route('staff')?->user_id)],
                'phone_number' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('users', 'phone_number')->ignore($this->route('staff')?->user_id)],
                'role' => ['sometimes', 'required', 'string', Rule::in([User::TEACHER, User::HOD, User::DEPUTY_HEAD_TEACHER])],
            ]);
        }

        return $rules;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->user() === null) {
                return;
            }

            $isCreate = $this->isMethod('POST');
            if ($this->user()->canManageStaff()) {
                return;
            }

            if ($isCreate) {
                $validator->errors()->add('user_id', 'Only head teachers and deputy head teachers can create staff records.');
            }
        });
    }
}
