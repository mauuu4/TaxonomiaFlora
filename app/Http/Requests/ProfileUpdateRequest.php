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
            'user_nombre' => ['required', 'string', 'max:50', 'regex:/^[\p{L}\s]+$/u'],
            'user_apellido' => ['required', 'string', 'max:50', 'regex:/^[\p{L}\s]+$/u'],
            'user_telefono' => ['required', 'digits:10'],
            'user_cedula' => [
                'required', 
                'string', 
                'size:10',
                'regex:/^[0-9]+$/',
                Rule::unique(User::class)->ignore($this->user()->user_id, 'user_id'),
            ],
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
    public function messages(): array
    {
        return [
            'user_nombre.required' => 'El nombre es obligatorio.',
            'user_nombre.string' => 'El nombre debe ser una cadena de texto.',
            'user_nombre.max' => 'El nombre no puede exceder los 50 caracteres.',
            'user_nombre.regex' => 'El nombre solo puede contener letras y espacios.',

            'user_apellido.required' => 'El apellido es obligatorio.',
            'user_apellido.string' => 'El apellido debe ser una cadena de texto.',
            'user_apellido.max' => 'El apellido no puede exceder los 50 caracteres.',
            'user_apellido.regex' => 'El apellido solo puede contener letras y espacios.',

            'user_telefono.required' => 'El teléfono es obligatorio.',
            'user_telefono.digits' => 'El teléfono debe contener exactamente 10 dígitos.',

            'user_cedula.required' => 'La cédula es obligatoria.',
            'user_cedula.string' => 'La cédula debe ser una cadena de texto.',
            'user_cedula.min' => 'La cédula debe contener 10 dígitos.',
            'user_cedula.max' => 'La cédula debe contener 10 dígitos.',
            'user_cedula.regex' => 'La cédula solo puede contener números.',
            'user_cedula.unique' => 'La cédula ya está en uso.',

            'user_email.required' => 'El correo electrónico es obligatorio.',
            'user_email.string' => 'El correo electrónico debe ser una cadena de texto.',
            'user_email.lowercase' => 'El correo electrónico debe estar en minúsculas.',
            'user_email.email' => 'El correo electrónico debe ser válido.',
            'user_email.max' => 'El correo electrónico no puede exceder los 35 caracteres.',
            'user_email.unique' => 'El correo electrónico ya está en uso.',
        ];
    }
}
