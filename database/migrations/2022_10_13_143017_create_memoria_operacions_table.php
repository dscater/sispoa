<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemoriaOperacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memoria_operacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("memoria_id");
            $table->string("ue", 255);
            $table->string("prog", 255);
            $table->string("act", 255);
            $table->unsignedBigInteger("operacion_id");
            $table->unsignedBigInteger("detalle_operacion_id");
            $table->string("lugar", 255);
            $table->string("responsable", 255);
            $table->string("partida", 255);
            $table->string("nro", 255);
            $table->text("descripcion");
            $table->float("cantidad");
            $table->string("unidad");
            $table->decimal("costo", 24, 2);
            $table->decimal("total", 24, 2);
            $table->text("justificacion");
            $table->decimal("ene", 24, 2)->nullable();
            $table->decimal("feb", 24, 2)->nullable();
            $table->decimal("mar", 24, 2)->nullable();
            $table->decimal("abr", 24, 2)->nullable();
            $table->decimal("may", 24, 2)->nullable();
            $table->decimal("jun", 24, 2)->nullable();
            $table->decimal("jul", 24, 2)->nullable();
            $table->decimal("ago", 24, 2)->nullable();
            $table->decimal("sep", 24, 2)->nullable();
            $table->decimal("oct", 24, 2)->nullable();
            $table->decimal("nov", 24, 2)->nullable();
            $table->decimal("dic", 24, 2)->nullable();
            $table->decimal("total_operacion", 24, 2);
            $table->timestamps();

            $table->foreign("memoria_id")->on("memoria_calculos")->references("id");
            $table->foreign("operacion_id")->on("operacions")->references("id");
            $table->foreign("detalle_operacion_id")->on("detalle_operacions")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memoria_operacions');
    }
}
