<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FCOperacion extends Model
{
    use HasFactory;

    protected $fillable = ['formulario_cinco_id', 'operacion_id', 'total_operacion'];

    protected $with = ["lugar_responsables", "operacion", "actividad_tareas"];

    public function lugar_responsables()
    {
        return $this->hasMany(LugarResponsable::class, 'fco_id');
    }

    public function operacion()
    {
        return $this->belongsTo(Operacion::class, 'operacion_id');
    }

    public function actividad_tareas()
    {
        return $this->hasMany(ActividadTarea::class, 'fco_id');
    }
}
