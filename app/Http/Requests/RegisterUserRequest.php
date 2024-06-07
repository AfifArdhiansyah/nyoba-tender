<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            "name" => ['required', 'string', 'min:5', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            "email" => ['required', 'string', 'email', 'max:255', 'unique:users'],
            "password" => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/', // at least one uppercase letter
                'regex:/[a-z]/', // at least one lowercase letter
                'regex:/[0-9]/', // at least one digit
                'regex:/[@$!%*#?&]/', // at least one special character
                'confirmed'
            ],
        ];
    }
}
