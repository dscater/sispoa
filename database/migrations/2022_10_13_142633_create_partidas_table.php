<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("lugar_responsable_id");
            $table->string("partida", 255);
            $table->string("descripcion", 255);
            $table->double("cantidad", 255);
            $table->string("unidad", 255);
            $table->decimal("costo", 24, 2);
            $table->decimal("t42", 24, 2);
            $table->string("ue");
            $table->string("prog");
            $table->string("act");
            $table->string("otros", 255)->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('partidas');
    }
}
