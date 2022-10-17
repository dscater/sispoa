<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    use HasFactory;

    protected $fillable = ['lugar_responsable_id', 'actividad_tarea_id', 'partida', 'descripcion', 'cantidad', 'unidad', 'costo', 't42', 'ue', 'prog', 'act', 'otros'];

    protected $appends = ["presupuesto", "total_por_actividad"];

    public function getPresupuestoAttribute()
    {
        return (float)$this->cantidad * (float)$this->costo;
    }

    public function getTotalPorActividadAttribute()
    {
        $actividad_tarea = ActividadTarea::find($this->actividad_tarea_id);
        if ($actividad_tarea) {
            return count($actividad_tarea->partidas);
        }
        return 1;
    }

    public function actividad_tarea()
    {
        return $this->belongsTo(ActividadTarea::class, 'actividad_tarea_id');
    }
}
