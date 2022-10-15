<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadTarea extends Model
{
    use HasFactory;

    protected $fillable = ['fco_id', 'detalle_operacion_id', 'lugar_responsable_id',];

    protected $appends = ["descripcion"];

    public function getDescripcionAttribute()
    {
        $detalle_operacion = DetalleOperacion::find($this->detalle_operacion_id);
        return $detalle_operacion->actividad_tarea;
    }
}
