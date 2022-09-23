<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user');
            $table->string('rut',12);
            $table->string('nombre');
            $table->string('apellido');
            $table->date('nacimiento')->nullable();
            $table->string('domicilio')->nullable();
            $table->unsignedBigInteger('id_estado');
            $table->unsignedBigInteger('id_actividad');
            $table->string('telefono')->nullable();
            $table->unsignedBigInteger('id_commune')->nullable();
            $table->boolean('activo')->default('1');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_estado')->references('id')->on('estados');
            $table->foreign('id_actividad')->references('id')->on('actividads');
            $table->foreign('id_commune')->references('id')->on('communes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
