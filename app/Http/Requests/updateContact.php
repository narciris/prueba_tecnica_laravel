<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateContact extends FormRequest
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
        $contactoId = $this->route('id');

        return [
            'nombre' => ['nullable', 'string', 'min:3', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:contactos,email,' . $contactoId],
            'telefono' => ['nullable', 'numeric', 'digits:10', 'unique:contactos,telefono,' . $contactoId],
            'notas' => ['nullable', 'string', 'min:10'],
            'fecha_nacimiento' => ['nullable', 'date', 'before:today'],
            'creado_por' => ['nullable', 'integer'],
            'entidad_id' => ['nullable', 'integer', 'exists:entidades,id'],
            'identificacion' => ['nullable', 'string', 'min:5', 'max:100'],
            'direccion' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'email.unique' => 'Este correo electrónico ya está en uso.',
            'telefono.unique' => 'Este número de teléfono ya está en uso.',
            'telefono.digits' => 'El número de teléfono debe tener exactamente 10 dígitos.',
            'notas.min' => 'Las notas deben tener al menos 10 caracteres.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser antes de hoy.',
            'identificacion.min' => 'La identificación debe tener al menos 5 caracteres.',
            'identificacion.max' => 'La identificación no puede tener más de 100 caracteres.',
            'direccion.max' => 'La dirección no puede tener más de 255 caracteres.',
        ];
    }
}
