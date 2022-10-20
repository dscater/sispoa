<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("formulario_id");
            $table->unsignedBigInteger("fco_id");
            $table->unsignedBigInteger("actividad_tarea_id");
            $table->unsignedBigInteger("partida_id");
            $table->double("cantidad_usar");
            $table->decimal("presupuesto_usarse", 24, 2);
            $table->text("justificacion");
            $table->string("archivo", 255)->nullable();
            $table->bigInteger("correlativo");
            $table->unsignedBigInteger("solicitante_id");
            $table->unsignedBigInteger("superior_id");
            $table->string("ue");
            $table->string("prog");
            $table->string("proy");
            $table->string("act");
            $table->string("ff");
            $table->string("of");
            $table->date("inicio");
            $table->date("final");
            $table->string("codigo", 255);
            $table->string("accion", 255);
            $table->string("estado", 255);
            $table->date("fecha_registro");

            $table->timestamps();
            $table->foreign("formulario_id")->on("formulario_cuatro")->references("id");
            $table->foreign("fco_id")->on("f_c_operacions")->references("id")->onUpdate("cascade");
            $table->foreign("actividad_tarea_id")->on("actividad_tareas")->references("id")->onUpdate("cascade");
            $table->foreign("partida_id")->on("partidas")->references("id")->onUpdate("cascade");
            $table->foreign("solicitante_id")->on("users")->references("id")->onUpdate("cascade");
            $table->foreign("superior_id")->on("users")->references("id")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificacions');
    }
}
