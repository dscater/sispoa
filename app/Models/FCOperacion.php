<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FCOperacion extends Model
{
    use HasFactory;

    protected $fillable = ['formulario_cinco_id', 'operacion_id', 'total_operacion'];

    protected $with = ["lugar_responsables"];

    public function lugar_responsables()
    {
        return $this->hasMany(LugarResponsable::class, 'fco_id');
    }
}
