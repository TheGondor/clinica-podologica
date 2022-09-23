<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitoMorbidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habito_morbidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_habito');
            $table->text('comentario')->nullable();

            $table->foreign('id_paciente')->references('id')->on('pacientes');
            $table->foreign('id_habito')->references('id')->on('habitos');

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
        Schema::dropIfExists('habito_morbidos');
    }
}
