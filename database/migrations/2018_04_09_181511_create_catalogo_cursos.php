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
            $table->string('presentacion')->nullable();
            $table->string('dirigido')->nullable();
            $table->string('objetivo')->nullable();
            $table->string('contenido')->nullable();
            $table->string('sintesis')->nullable();
            $table->string('metodologia')->nullable();
            $table->String('acreditacion')->nullable();
            $table->string('previo')->nullable();
            $table->string('evaluacion')->nullable();
            $table->string('bibliografia')->nullable();
            $table->date('fecha_disenio');
            $table->integer('coordinacion_id')->unsigned();
            $table->string('clave_curso')->unique();

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
