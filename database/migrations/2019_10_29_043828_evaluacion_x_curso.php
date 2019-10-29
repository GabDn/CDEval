<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EvaluacionXCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_evaluacion_x_curso', function (Blueprint $table) {
            $table->increments('id');
            $table->char('p1',1); 
            $table->char('p2',1);
            $table->char('p3',1);
            $table->char('p4',1);
            $table->char('p5',1);
            $table->char('p6',1);
            $table->string('contenido',300); 
            $table->string('sug',300); 
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
        Schema::dropIfExists('_evaluacion_x_curso');
    }
}
