<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioCuatro extends Model
{
    use HasFactory;

    protected $table = "formulario_cuatro";

    protected $fillable = [
        'codigo_pei', 'accion_institucional', 'indicador', 'codigo_poa',
        'accion_corto', 'resultado_esperado', 'presupuesto', 'ponderacion',
        'unidad_id', 'fecha_registro'
    ];

    protected $with = ["unidad"];

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id');
    }

    public function detalle_formulario()
    {
        return $this->hasOne(DetalleFormulario::class, 'formulario_id');
    }

    public function formulario_cinco()
    {
        return $this->hasOne(FormularioCinco::class, 'formulario_id');
    }
}
