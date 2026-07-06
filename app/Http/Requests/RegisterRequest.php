<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],

            'phone' => [
                'required',
                'string',
                'max:20',
                'unique:users,phone'
            ],

            'role_id' => [
                'required',
                'exists:roles,id'
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8'
            ]

        ];
    }

    public function messages(): array
    {
        return [

            'email.unique' => 'This email is already registered.',

            'phone.unique' => 'This phone number is already registered.'

        ];
    }
}