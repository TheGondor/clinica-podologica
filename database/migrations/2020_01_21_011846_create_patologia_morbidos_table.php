<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatologiaMorbidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patologia_morbidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_patologia');
            $table->string('tecnica')->nullable();
            $table->longText('protocolo')->nullable();
            $table->text('comentario')->nullable();
            $table->boolean('activo')->default('1');

            $table->foreign('id_paciente')->references('id')->on('pacientes');
            $table->foreign('id_patologia')->references('id')->on('patologias');
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
        Schema::dropIfExists('patologia_morbidos');
    }
}
