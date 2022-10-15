<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operacion extends Model
{
    use HasFactory;

    protected $fillable = [
        "detalle_formulario_id", "codigo_operacion", "operacion",
    ];

    protected $with = ["detalle_operaciones"];

    public function detalle_operaciones()
    {
        return $this->hasMany(DetalleOperacion::class, 'operacion_id');
    }
}