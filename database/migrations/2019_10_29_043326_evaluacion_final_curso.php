<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EvaluacionFinalCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_evaluacion_final_curso', function (Blueprint $table) {
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
            //4. INSTRUCTOR UNO
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
            //5. INSTRUCTOR DOS
            $table->char('p5_1',1);
            $table->char('p5_2',1);
            $table->char('p5_3',1);
            $table->char('p5_4',1);
            $table->char('p5_5',1);
            $table->char('p5_6',1);
            $table->char('p5_7',1);
            $table->char('p5_8',1);
            $table->char('p5_9',1);
            $table->char('p5_10',1);
            $table->char('p5_11',1);
            //6.¿RECOMENDARÍA EL CURSO A OTROS PROFESORES?
            $table->char('p6',1);
            //7. ¿CÓMO SE ENTERÓ DEL CURSO?
            $table->string('p7',15);
            //Lo mejor del curso fue:
            $table->string('mejor',300);
            //Sugerencias y recomendaciones:	
            $table->string('sug',300);
            //¿Qué otros cursos, talleres, seminarios o temáticos le gustaría que se impartiesen o tomasen en cuenta para próximas actividades?
            $table->string('otros',300);
            //ÁREA DE CONOCIMIENTO
            $table->string('conocimiento',15);
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
          Schema::dropIfExists('_evaluacion_final_curso');
      }
}
