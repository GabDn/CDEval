<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EvaluacionXSeminario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_evaluacion_x_seminario', function (Blueprint $table) {
            $table->increments('id');
          $table->char('p1',1); 
          $table->string('p1_arg',300);
          $table->char('p2',1); 
          $table->string('p2_arg',300);
          $table->char('p3',1); 
          $table->string('p3_arg',300);
          $table->char('p4',1); 
          $table->string('p4_arg',300);
          $table->char('p5',1); 
          $table->string('p5_arg',300);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_evaluacion_x_seminario');
    }
}
