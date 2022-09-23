<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtencionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atencions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_paciente');
            $table->date('atencion_fecha')->useCurrent();
            $table->string('atencion_pa')->nullable();
            $table->bigInteger('atencion_pulso_radial')->nullable();
            $table->bigInteger('atencion_peso')->nullable();
            $table->string('atencion_pedio_d')->nullable();
            $table->string('atencion_pedio_i')->nullable();
            $table->string('atencion_sensibilidad_d')->nullable();
            $table->string('atencion_sensibilidad_i')->nullable();
            $table->bigInteger('atencion_t_podal')->nullable();
            $table->bigInteger('valor')->nullable();
            $table->string('atencion_podal')->nullable();
            $table->string('atencion_curacion')->nullable();
            $table->string('atencion_colocacion')->nullable();
            $table->string('atencion_resecado')->nullable();
            $table->string('atencion_enucleasion')->nullable();
            $table->string('atencion_devastado')->nullable();
            $table->string('atencion_masoterapia')->nullable();
            $table->string('atencion_espiculoectomia')->nullable();
            $table->string('atencion_analgesia')->nullable();
            $table->string('atencion_acrilico')->nullable();
            $table->string('atencion_banda')->nullable();
            $table->string('atencion_bracket')->nullable();
            $table->string('atencion_policarboxilato')->nullable();
            $table->text('atencion_descripcion')->nullable();
            $table->boolean('activo')->default('1');
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
        Schema::dropIfExists('atencions');
    }
}
