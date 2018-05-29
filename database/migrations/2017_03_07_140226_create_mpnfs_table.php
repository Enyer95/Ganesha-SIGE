<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpnfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpnfs', function (Blueprint $table) {
            $table->increments('cod_pnf');
            $table->string('nom_pnf', 30);
            $table->integer('cant_secc');
            $table->integer('cant_uni');
            $table->integer('tiempo_respaldo');
            $table->date('fecha_final');
            $table->boolean('enabled')->default(false);
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
        Schema::dropIfExists('mpnfs');
    }
}
