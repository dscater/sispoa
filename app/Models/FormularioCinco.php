<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioCinco extends Model
{
    use HasFactory;
    protected $table = "formulario_cinco";

    protected $fillable = ['memoria_id', "fecha_registro"];

    protected $with = ["memoria"];

    public function memoria()
    {
        return $this->belongsTo(MemoriaCalculo::class, 'memoria_id');
    }
}
