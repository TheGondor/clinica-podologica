<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnfermedadMorbidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enfermedad_morbidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_enfermedad');
            $table->text('comentario')->nullable();

            $table->foreign('id_paciente')->references('id')->on('pacientes');
            $table->foreign('id_enfermedad')->references('id')->on('enfermedads');

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
        Schema::dropIfExists('enfermedad_morbidos');
    }
}
