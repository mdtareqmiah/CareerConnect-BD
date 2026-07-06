<?php

namespace App\Http\Requests\Auth;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'phone' => [
                'required',
                'string',
                'max:20',
                'unique:users,phone',
            ],

            'role_id' => [
                'required',
                'integer',
                'exists:roles,id',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
            ],

        ];
    }

    /**
     * Custom Validation Messages
     */
    public function messages(): array
    {
        return [

            'name.required' => 'Full name is required.',

            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'This email is already registered.',

            'phone.required' => 'Phone number is required.',
            'phone.unique' => 'This phone number is already registered.',

            'role_id.required' => 'Please select an account type.',
            'role_id.exists' => 'Invalid account type selected.',

            'password.required' => 'Password is required.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }

    /**
     * Additional Validation
     */
    public function after(): array
    {
        return [

            function ($validator) {

                if (!$this->filled('role_id')) {
                    return;
                }

                $allowedRoleIds = Role::query()
                    ->whereIn('slug', [
                        'employer',
                        'job_seeker'
                    ])
                    ->pluck('id')
                    ->toArray();

                if (!in_array((int) $this->role_id, $allowedRoleIds, true)) {

                    $validator->errors()->add(
                        'role_id',
                        'You are not allowed to register with this account type.'
                    );

                }

            }

        ];
    }
}