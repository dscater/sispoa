<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'formulario_id', 'detalle_formulario_id', 'detalle_operacion_id', 'partida_id',
        'cantidad_usar', 'justificacion', 'archivo', 'correlativo', 'solicitante_id', 'superrior_id',
        'ue', 'prog', 'proy', 'act', 'ff', 'of', 'codigo', 'accion', 'fecha_registro',
    ];
}
