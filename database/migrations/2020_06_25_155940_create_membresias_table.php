<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembresiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membresias', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->integer('valor')->nullable();
            $table->date('fecha_creacion')->nullable();
            $table->unsignedInteger('id_usuario')->nullable();
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->unsignedInteger('id_plan')->nullable();
            $table->foreign('id_plan')->references('id')->on('plans');
            $table->unsignedInteger('id_admin')->nullable();
            $table->foreign('id_admin')->references('id')->on('usuarios');
            $table->unsignedInteger('id_estado_membresia')->nullable();
            $table->foreign('id_estado_membresia')->references('id')->on('estado_membresia');
            $table->unsignedInteger('id_estado')->nullable();
            $table->foreign('id_estado')->references('id')->on('estados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membresias');
    }
}
