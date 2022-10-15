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
            $table->unsignedBigInteger("detalle_formulario_id");
            $table->unsignedBigInteger("detalle_operacion_id");
            $table->unsignedBigInteger("partida_id");
            $table->double("cantidad_usar");
            $table->text("justificacion");
            $table->string("archivo", 255);
            $table->bigInteger("correlativo");
            $table->unsignedBigInteger("solicitante_id");
            $table->unsignedBigInteger("superrior_id");
            $table->string("ue");
            $table->string("prog");
            $table->string("proy");
            $table->string("act");
            $table->string("ff");
            $table->string("of");
            $table->string("codigo", 255);
            $table->string("accion", 255);
            $table->date("fecha_registro");

            $table->timestamps();
            $table->foreign("formulario_id")->on("formulario_cuatro")->references("id");
            $table->foreign("detalle_formulario_id")->on("detalle_formularios")->references("id");
            $table->foreign("detalle_operacion_id")->on("detalle_operacions")->references("id");
            $table->foreign("partida_id")->on("partidas")->references("id");
            $table->foreign("solicitante_id")->on("users")->references("id");
            $table->foreign("superrior_id")->on("users")->references("id");
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
