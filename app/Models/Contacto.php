<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model

{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'email',
        'direccion',
        'telefono',
        'asunto',
        'notas',
        'fecha_nacimiento',
        'creado_por',
        'entidad_id',
        'identificacion',
    ];

    public function entidad()
    {
        return $this->belongsTo(Contacto::class);
    }
}
