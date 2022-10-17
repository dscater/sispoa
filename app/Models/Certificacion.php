<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'formulario_id', 'fco_id', 'actividad_tarea_id', 'partida_id',
        'cantidad_usar','presupuesto_usarse', 'justificacion', 'archivo', 'correlativo', 'solicitante_id', 'superior_id',
        'ue', 'prog', 'proy', 'act', 'ff', 'of', 'codigo', 'accion', 'estado', 'fecha_registro',
    ];

    protected $with = ["formulario", "operacion", "actividad_tarea", "partida"];

    public function formulario()
    {
        return $this->belongsTo(FormularioCuatro::class, 'formulario_id');
    }

    public function operacion()
    {
        return $this->belongsTo(FCOperacion::class, 'fco_id');
    }

    public function actividad_tarea()
    {
        return $this->belongsTo(ActividadTarea::class, 'actividad_tarea_id');
    }

    public function partida()
    {
        return $this->belongsTo(Partida::class, 'partida_id');
    }

    public function solicitante()
    {
        return $this->belongsTo(User::class, 'solicitante_id');
    }

    public function superior()
    {
        return $this->belongsTo(User::class, 'superior_id');
    }

}
