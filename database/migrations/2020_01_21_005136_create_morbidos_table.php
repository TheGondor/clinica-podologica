<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMorbidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('morbidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_paciente');
            $table->string('hta');
            $table->string('dm');
            $table->string('tipo')->nullable();
            $table->unsignedInteger('anos_evolucion')->nullable();
            $table->string('pcte_mixto');
            $table->string('control');
            $table->string('ortopedia')->nullable();
            $table->boolean('activo')->default('1');
            $table->date('fecha');
            $table->timestamps();

            $table->foreign('id_paciente')->references('id')->on('pacientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('morbidos');
    }
}
