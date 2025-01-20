<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{

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
            'user_cedula' => ['required', 'regex:/^[0-9]{10}$/', 'max:10', Rule::unique(User::class)->ignore($this->user()->user_id, 'user_id')],
            'user_nombre' => ['required', 'string', 'max:50', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'user_apellido' => ['required', 'string', 'max:50', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'user_telefono' => ['required', 'regex:/^[0-9]{10}$/', 'max:10'],
            'user_email' => [
                'required',
                'string',
                'lowercase',
                'email', 
                'max:35', 
                Rule::unique(User::class)->ignore($this->user()->user_id, 'user_id'),
            ],
        ];
    }
}
