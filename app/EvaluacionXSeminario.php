<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluacionXSeminario extends Model
{
   protected $table = '_evaluacion_x_seminario';

   protected $fillable = [
      'id',
      'p1',
      'p1_arg',
      'p2',
      'p2_arg',
      'p3',
      'p3_arg',
      'p4',
      'p4_arg',
      'p5',
      'p5_arg'
   ];
   public $timestamps = false;
}
