<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFCOperacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_c_operacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("formulario_cinco_id");
            $table->unsignedBigInteger("operacion_id");
            $table->decimal("total_operacion", 24, 2);
            $table->timestamps();

            $table->foreign("formulario_cinco_id")->on("formulario_cinco")->references("id");
            $table->foreign("operacion_id")->on("operacions")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('f_c_operacions');
    }
}
