<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EvaluacionFinalSeminario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_evaluacion_final_seminario', function (Blueprint $table) {
        $table->increments('id');
        //1. DESARROLLO DEL CURSO
        $table->char('p1_1',1);
        $table->char('p1_2',1);
        $table->char('p1_3',1);
        $table->char('p1_4',1);
        $table->char('p1_5',1);
        //2. AUTOEVALUACION
        $table->char('p2_1',1);
        $table->char('p2_2',1);
        $table->char('p2_3',1);
        $table->char('p2_4',1);
          //3. COORDINACION DEL CURSO
          $table->char('p3_1',1);
          $table->char('p3_2',1);
          $table->char('p3_3',1);
          $table->char('p3_4',1);
          //4. FACILITADOR(A) DEL SEMINARIO
          $table->char('p4_1',1);
          $table->char('p4_2',1);
          $table->char('p4_3',1);
          $table->char('p4_4',1);
          $table->char('p4_5',1);
          $table->char('p4_6',1);
          $table->char('p4_7',1);
          $table->char('p4_8',1);
          $table->char('p4_9',1);
          $table->char('p4_10',1);
          $table->char('p4_11',1);
          //5.¿RECOMENDARÍA EL CURSO A OTROS PROFESORES?
          $table->char('p5',1);
          //6. ¿CÓMO SE ENTERÓ DEL SEMINARIO?  //es un arreglo :v puede que seleccione más de una opción xd
          $table->string('p6',15);
          //Lo que me aportó el seminario fue:
          $table->string('aporto',300);
          //Sugerencias y recomendaciones:	
          $table->string('sug',300);
          //¿Qué otros cursos, talleres, seminarios o temáticos le gustaría que se impartiesen o tomasen en cuenta para próximas actividades?
          $table->string('otros',300);
          //ÁREA DE CONOCIMIENTO
          $table->string('conocimiento',300);
          //Temáticas:	
          $table->string('tematica',300);
          //¿En qué horarios le gustaría que se impartiesen los cursos, talleres, seminarios o diplomados?
          //Horarios Semestrales:
          $table->string('horarios',15);
          //Horarios Intersemestrales:
          $table->string('horarioi',15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_evaluacion_final_seminario');
    }
}
