<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioCinco extends Model
{
    use HasFactory;
    protected $table = "formulario_cinco";

    protected $fillable = ['formulario_id', 'total_formulario', 'fecha_registro'];

    protected $with = ["formulario", "operacions"];

    public function formulario()
    {
        return $this->belongsTo(FormularioCuatro::class, 'formulario_id');
    }

    public function operacions()
    {
        return $this->hasMany(FCOperacion::class, 'formulario_cinco_id');
    }
}
