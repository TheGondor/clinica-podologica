<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImplementoAtencionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('implemento_atencions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_atencion');
            $table->unsignedBigInteger('id_implemento');
            $table->unsignedBigInteger('cantidad');
            $table->unsignedBigInteger('costo_individual');
            $table->unsignedBigInteger('costo_total');

            $table->foreign('id_atencion')->references('id')->on('atencions');
            $table->foreign('id_implemento')->references('id')->on('implementos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('implemento_atencions');
    }
}
