<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCursos extends Migration
{
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('semestre_imparticion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('hora_inicio');
            $table->string('hora_fin');
            $table->String('dias_semana')->nullable();
            $table->integer('numero_sesiones');
            $table->string('texto_diploma');
            $table->integer('profesor_id')->unsigned()->nullable();
            $table->double('costo');
            $table->String('orden');
            $table->date('fecha_disenio');
            $table->integer('cupo_maximo');
            $table->integer('cupo_minimo');
            $table->String('status');
            $table->integer('catalogo_id')->unsigned();
            $table->integer('salon_id')->unsigned();

            $table->foreign('profesor_id')->references('id')->on('profesors');
            $table->foreign('catalogo_id')->references('id')->on('catalogo_cursos');
            $table->foreign('salon_id')->references('id')->on('salons');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
}
