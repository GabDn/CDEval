<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profesor;
use App\Curso;
use App\CatalogoCurso;
use App\ParticipantesCurso;
// use App\Coordinacion;
use App\Http\Controllers\Controller;
use Session; 
use Illuminate\Support\Facades\Hash;

class ProfesorController extends Controller
{
    //
	function index($id){
		$profesor = Profesor::findOrFail($id);
		$cursos = ParticipantesCurso::where('profesor_id', $id)->select('curso_id')->get();
		$cursos = Curso::whereIn('id',$cursos)->get();
		return view('pages.admin')
			->with("profesor",$profesor)
			->with("cursos", $cursos);

	}
}
