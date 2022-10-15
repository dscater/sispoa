<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad_tareas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("fco_id");
            $table->unsignedBigInteger("detalle_operacion_id");
            $table->unsignedBigInteger("lugar_responsable_id");
            $table->timestamps();
            $table->foreign("fco_id")->on("f_c_operacions")->references("id");
            $table->foreign("detalle_operacion_id")->on("detalle_operacions")->references("id");
            $table->foreign("lugar_responsable_id")->on("lugar_responsables")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividad_tareas');
    }
}
