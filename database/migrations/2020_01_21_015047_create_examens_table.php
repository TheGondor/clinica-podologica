<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_paciente');
            $table->string('pulso_radial')->nullable();
            $table->string('pa')->nullable();
            $table->string('pulso_pedio_d')->nullable();
            $table->string('pulso_pedio_i')->nullable();
            $table->bigInteger('peso')->nullable();
            $table->bigInteger('talla')->nullable();
            $table->bigInteger('imc')->nullable();
            $table->string('amputacion')->nullable();
            $table->string('ubicacion')->nullable();
            $table->bigInteger('calzado')->nullable();
            $table->string('sensibilidad_d')->nullable();
            $table->string('sensibilidad_i')->nullable();
            $table->string('t_podal_d')->nullable();
            $table->string('t_podal_i')->nullable();
            $table->string('varices')->nullable();
            $table->string('herida')->nullable();
            $table->string('heridas')->nullable();
            $table->string('tipo')->nullable();
            $table->string('tratamiento')->nullable();
            $table->string('nevo')->nullable();
            $table->string('nevos')->nullable();
            $table->string('macula')->nullable();
            $table->string('maculas')->nullable();
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
        Schema::dropIfExists('examens');
    }
}
