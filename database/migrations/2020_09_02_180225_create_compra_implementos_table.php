<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraImplementosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_implementos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_implemento');
            $table->text('comentario');
            $table->unsignedBigInteger('cantidad');
            $table->unsignedBigInteger('precio_total');
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
        Schema::dropIfExists('compra_implementos');
    }
}
