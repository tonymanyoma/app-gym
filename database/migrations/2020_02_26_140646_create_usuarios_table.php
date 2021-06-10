<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_tipo_documento')->nullable();
            $table->foreign('id_tipo_documento')->references('id')->on('tipo_documentos');
            $table->string('numero_documento',20);
            $table->string('nombre_completo',150);
            $table->string('telefono',20)->nullable();
            $table->string('direccion',100)->nullable();
            $table->string('email',50)->nullable();
            $table->date('fecha_nacimiento');
            $table->integer('year_nacimiento');
            $table->integer('sexo');
            $table->string('password',100)->nullable();
            $table->unsignedInteger('id_role')->nullable();
            $table->foreign('id_role')->references('id')->on('roles');
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
        Schema::dropIfExists('usuarios');
    }
}
