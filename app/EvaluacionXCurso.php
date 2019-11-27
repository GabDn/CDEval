<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluacionXSeminario extends Model
{
   protected $table = '_evaluacion_x_seminario';

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
