<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class contactRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:contactos,email'],
            'direccion' => ['nullable', 'string', 'min:3', 'max:255'],
            'telefono' => ['nullable', 'numeric', 'digits:10', 'unique:contactos,telefono'],
            'notas' => ['nullable', 'string', 'min:10'],
            'fecha_nacimiento' => ['nullable', 'date', 'before:today'],
            'creado_por' => ['nullable', 'integer'],
            'entidad_id' => ['required', 'integer', 'exists:entidades,id'],
            'identificacion' => ['required', 'string', 'min:5', 'max:100'],
        ];

    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.min' => 'El nombre debe tener al menos :min caracteres.',
            'nombre.max' => 'El nombre no debe exceder los :max caracteres.',

            'email.email' => 'El correo electrónico no tiene un formato válido.',
            'email.max' => 'El correo electrónico no debe superar los :max caracteres.',
            'email.unique' => 'Este correo ya está registrado.',

            'telefono.numeric' => 'El teléfono debe ser un número.',
            'telefono.digits' => 'El teléfono debe tener exactamente :digits dígitos.',
            'telefono.unique' => 'Este número de teléfono ya está registrado.',

            'notas.string' => 'Las notas deben ser texto.',
            'notas.min' => 'Las notas deben tener al menos :min caracteres.',

            'fecha_nacimiento.date' => 'La fecha de nacimiento no es válida.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser anterior a hoy.',

            'creado_por.integer' => 'El campo creado por debe ser un número entero.',

            'entidad_id.required' => 'Debe seleccionar una entidad.',
            'entidad_id.integer' => 'El ID de la entidad debe ser un número entero.',
            'entidad_id.exists' => 'La entidad seleccionada no existe.',

            'identificacion.required' => 'La identificación es obligatoria.',
            'identificacion.string' => 'La identificación debe ser una cadena de texto.',
            'identificacion.min' => 'La identificación debe tener al menos :min caracteres.',
            'identificacion.max' => 'La identificación no debe superar los :max caracteres.',
        ];

    }
}
