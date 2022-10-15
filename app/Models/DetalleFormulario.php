<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFormulario extends Model
{
    use HasFactory;

    protected $fillable = [
        'formulario_id', 'fecha_registro',
    ];

    protected $with = ["formulario", "operacions"];

    public function formulario()
    {
        return $this->belongsTo(FormularioCuatro::class, 'formulario_id');
    }

    public function operacions()
    {
        return $this->hasMany(Operacion::class, 'detalle_formulario_id');
    }
}
