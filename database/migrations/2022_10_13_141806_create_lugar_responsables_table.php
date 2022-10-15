<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLugarResponsablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lugar_responsables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("fco_id");
            $table->string("lugar", 255);
            $table->string("responsable", 255);
            $table->timestamps();
            $table->foreign("fco_id")->on("f_c_operacions")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lugar_responsables');
    }
}
