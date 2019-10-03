<?php

namespace App\Http\Controllers;
use App\Profesor;
use App\Curso;
use App\CatalogoCurso;
use App\ParticipantesCurso;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class EvaluacionController extends Controller{


     public function index($profesor_id, $curso_id, $catalogoCurso_id){
 
      $profesor = Profesor::find($profesor_id);
      $curso = Curso::find($curso_id);
      $catalogoCurso = CatalogoCurso::find($catalogoCurso_id);
      //return "It's not my fault";
      return view("pages.evaluacionIndex")
      ->with("profesor",$profesor)
      ->with("curso",$curso)
      ->with('catalogoCurso',$catalogoCurso);

     }
       

}
