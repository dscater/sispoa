<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificacion extends Model
{
    use HasFactory;

    protected $fillable = [
        "formulario_id", "mo_id", "cantidad_usar", "presupuesto_usarse", "archivo",
        "correlativo", "solicitante_id", "superior_id", "inicio", "final", "persona_beneficiaria",
        "estado", "fecha_registro",
    ];

    protected $with = ["formulario", "memoria_operacion"];

    public function formulario()
    {
        return $this->belongsTo(FormularioCuatro::class, 'formulario_id');
    }

    public function memoria_operacion()
    {
        return $this->belongsTo(MemoriaOperacion::class, 'mo_id');
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
