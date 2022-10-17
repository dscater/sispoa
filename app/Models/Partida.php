<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    use HasFactory;

    protected $fillable = ['lugar_responsable_id', 'partida', 'descripcion', 'cantidad', 'unidad', 'costo', 't42', 'ue', 'prog', 'act', 'otros'];

    protected $append = ["presupuesto"];

    public function getPresupuestoAttribute()
    {
        return (float)$this->cantidad * (float)$this->costo;
    }
}
