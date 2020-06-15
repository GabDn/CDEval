<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session; 
use App\Curso;
use App\CatalogoCurso;
use App\Profesor;
use App\ProfesoresCurso;
use App\EvaluacionXCurso;
use App\Coordinacion;
use Illuminate\Support\Facades\DB;
use PDF;

class CoordinadorController extends Controller
{
    public function cursos(){
        $cursos = Curso::all();
        return view("pages.cursos")->with("cursos",$cursos);
    }

    public function searchCursos(Request $request){      
        if ($request->type == "nombre") {
            $catalogos_res = CatalogoCurso::select('id')->where('nombre_curso','ILIKE','%'.$request->pattern.'%')->get();
            $res_busqueda = Curso::whereIn('catalogo_id', $catalogos_res)
                ->get();
            return view('pages.cursos')->with("cursos",$res_busqueda);
            
        }elseif ($request->type == "instructor"){
            $words=explode(" ", $request->pattern);
            foreach($words as $word){
                $profesores = Profesor::select('id')->where('nombres','ILIKE','%'.$word.'%')
                ->orWhere('apellido_paterno','ILIKE','%'.$word.'%')
                ->orWhere('apellido_materno','ILIKE','%'.$word.'%')
                ->get();
            }
            $curso_prof = ProfesoresCurso::select('curso_id')->whereIn('profesor_id', $profesores)->get();
            $res_busqueda = Curso::whereIn('id',$curso_prof)->get();
            return view('pages.cursos')->with("cursos",$res_busqueda);
        }
    }

    public function cursosCoordinaciones($encargado_id){
        $coordinaciones = Coordinacion::all();
        $cursos = Curso::Join('catalogo_cursos','cursos.catalogo_id','=','catalogo_cursos.id')
                  ->where('catalogo_cursos.coordinacion_id',$encargado_id)->get();
        return view("pages.cursos")
            ->with("cursos",$cursos)
            ->with("coordinaciones",$coordinaciones);
    }



    public function searchCursosCoordinaciones(Request $request){

    }
    
    public function sesiones(){
        $evaluacion = EvaluacionXCurso::all();
        $coordinaciones = Coordinacion::all();
        //return $evaluacion;
        return view('pages.sesiones')
        ->with("coordinaciones",$coordinaciones);
    }

    public function globales(){
        $coordinaciones = Coordinacion::all();
        return view('pages.globales')
        ->with("coordinaciones",$coordinaciones);
    }
    
    public function instructores(){
        return view("pages.instructores");
    }

    public function area_pdf(){
        $pdf = PDF::loadView('pages.area');
        return $pdf->download('Evaluacion_area.pdf');
    }




}
