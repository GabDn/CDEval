<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogoCursos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogo_cursos', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('nombre_curso');
            $table->string('duracion_curso');
            $table->string('tipo');
            $table->string('tipo_curso_diploma_instructor');
            $table->string('presentacion')->nullable();
            $table->string('tipo_difusion')->nullable();
            $table->string('dirigido')->nullable();
            $table->string('objetivo')->nullable();
            $table->string('contenido')->nullable();
            $table->string('sintesis')->nullable();
            $table->string('metodologia')->nullable();
            $table->String('acreditacion');
            $table->string('evaluacion');
            $table->string('bibliografia');
            $table->string('antecedentes');
            $table->string('consecuentes');
            $table->date('fecha_disenio');
            $table->integer('coordinacion_id')->unsigned();
            $table->string('clave_curso');

            $table->foreign('coordinacion_id')->references('id')->on('coordinacions');

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
        Schema::dropIfExists('catalogo_cursos');
    }
}
