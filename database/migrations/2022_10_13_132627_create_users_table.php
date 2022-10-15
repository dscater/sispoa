<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('usuario')->unique();
            $table->string("nombre", 255);
            $table->string("paterno", 255);
            $table->string("materno", 255)->nullable();
            $table->string("ci", 40);
            $table->string("ci_exp", 20);
            $table->string("dir", 255);
            $table->string('correo')->nullable();
            $table->string("fono", 155);
            $table->string("cel", 155);
            $table->string("cargo", 255);
            $table->unsignedBigInteger("unidad_id")->nullable();
            $table->string("tipo", 255);
            $table->string("foto", 255)->nullable();
            $table->string('password');
            $table->date("fecha_registro");
            $table->timestamps();
            $table->foreign("unidad_id")->on("unidads")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}