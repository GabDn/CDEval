<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluacionFinalSeminario extends Model
{
   protected $table = '_evaluacion_final_seminario';

   protected $fillable = [
    'p1_1',
    'p1_2',
    'p1_3',
    'p1_4',
    'p1_5',
    'p2_1',
    'p2_2',
    'p2_3',
    'p2_4',
    'p3_1',
    'p3_2',
    'p3_3',
    'p3_4',
    'p4_1',
    'p4_2',
    'p4_3',
    'p4_4',
    'p4_5',
    'p4_6',
    'p4_7',
    'p4_8',
    'p4_9',
    'p4_10',
    'p4_11',
    'p6',
    'p7',
    'aporto',
    'sug',
    'otros',
    'conocimiento',
    'tematica',
    'horarios',
    'horarioi'
   ];
}
