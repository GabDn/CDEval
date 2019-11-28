<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluacionXCurso extends Model
{
   protected $table = '_evaluacion_x_curso';

   protected $fillable = [
      'p1',
      'p2',
      'p3',
      'p4',
      'p5',
      'p6',
      'p7',
      'contenido',
      'sug'
   ];
   public $timestamps = false;
}
