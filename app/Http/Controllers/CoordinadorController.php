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
use Illuminate\Support\Facades\Storage;
use Mail;
use PDF;
use DB; 

ini_set('max_execution_time', '500');

class CoordinadorController extends Controller
{

    public function index(){

    }

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

    public function enviarGlobal(Request $request){
        //Obtenemos la fecha elegida por el usuario
        $fecha = $request->get('semestre');
        $semestre = explode('-',$fecha);

        //Obtenemos los cursos correspondientes al semestre elegido por el usuario
        $cursos = DB::table('cursos')
            ->where([['cursos.semestre_anio',$semestre[0]],['cursos.semestre_pi',$semestre[1]]])
            ->get();

        //Indicamos la vista a observar
        $lugar = "pages.reporte_final_global";

        return $this->enviarVista($fecha, $cursos, "", $lugar,0);
    }

    public function enviarVista($request, $cursos, $nombreCoordinacion, $lugar, $pdf){

        //Obtenemos todos los coordinadores
        $coordinaciones = Coordinacion::all();

        $evaluacionesCursos = array();

        $nombresCursos = array();
        $inscritos = 0;
        $acreditaron = 0;
        $capacidad_total = 0;
        $asistieron = 0;

        //Usado para la seccion 2 de evaluacion_global
        foreach($cursos as $curso){

            //Aumentamos la capacidad total de todos los cursos
            $capacidad_total += intval($curso->cupo_maximo);
            $catalogo = DB::table('catalogo_cursos')
                ->where('id',$curso->catalogo_id)
                ->get();

            //Obtenemos los nombres de los cursos
            array_push($nombresCursos,$catalogo[0]->nombre_curso);

            //Las evaluaciones finales de los cursos
            $eval = DB::table('_evaluacion_final_curso')
                ->where('curso_id',$curso->id)
                ->get();
            
            //Las evaluaciones finales de los seminarios
            $eval2 = DB::table('_evaluacion_final_seminario')
                ->where('curso_id',$curso->id)
                ->get();

            //Obtenemos los participantes de los cursos
            $participantes = DB::table('participante_curso')
                ->where('curso_id',$curso->id)
                ->get();

            //Necesario para el factor de acreditacion
            foreach($participantes as $participante){
                if($participante->acreditacion == 1){
                    //Aumentamos la cantidad de acreditaciones
                    $acreditaron++;
                }
                if($participante->asistencia == 1){
                    //Aumentamos la cantidad de asistencia
                    $asistieron++;
                }
            }

            //Aumentamos la cantidad de inscritos
            $inscritos += sizeof($participantes);

            //Si hay evaluacions finales de cursos los incluimos en el arreglo de evaluacionesCursos
            if(sizeof($eval)>0){
                array_push($evaluacionesCursos,$eval);
            }
            //Si hay evaluacions finales de seminarios los incluimos en el arreglo de evaluacionesCursos
            if(sizeof($eval2)>0){
                array_push($evaluacionesCursos,$eval2);
            }
        }

        $DP=0;
        $DH=0;
        $CO=0;
        $DI=0;
        $Otros=0;
        $DPtematica = array();
        $DHtematica = array();
        $COtematica = array();
        $DItematica = array();
        $Otrostematica = array();
        //Obtenemos la cantidad de participantes de cada division y las tematcias solicitadas por cada division
        foreach($evaluacionesCursos as $evals)
            foreach($evals as $evaluacion){
                $array = explode(',',$evaluacion->conocimiento);
                foreach($array as $elem){
                    if($elem[2] == 1 || $elem[1] == 1){
                        $DP++;
                        array_push($DPtematica,$evaluacion->tematica);
                    }else if($elem[2] == 2 || $elem[1] == 2){
                        $DH++;
                        array_push($DHtematica,$evaluacion->tematica);
                    }else if($elem[2] == 3 || $elem[1] == 3){
                        $CO++;
                        array_push($COtematica,$evaluacion->tematica);
                    }else if($elem[2] == 4 || $elem[1] == 4){
                        $DI++;
                        array_push($DItematica,$evaluacion->tematica);
                    }else if($elem[2] == 5 || $elem[1] == 5){
                        $Otros++;
                        array_push($Otrostematica,$evaluacion->tematica);
                    }
                }
		    }
		
        $alumnos = 0;
        $contestaron = 0;
        $recomendaciones = 0;
        $alumnosRecomendaron = 0;
        $positivas = 0;
        $preguntas = 0;
        $respuestasContenido = 0;
        $respuestasCoordinacion = 0;
        $horariosCurso = array();
        $profesoresRecontratar = array();
        $curso_recomendaron = 0;
        $desempenioProfesor = 0;
        $evaluacionProfesor = 0;

        foreach($evaluacionesCursos as $curso){

            $curso_id = $curso[0]->curso_id;
            $profesores = DB::table('profesor_curso')
                ->where('curso_id',$curso_id)
                ->get();

            $acreditaronCurso = 0;
            $alumno_curso = 0;
            $recomendaciones_curso = 0;
            $alumnos_recomendaron_curso = 0;
            $positivas_curso = 0;
            $preguntas_curso = 0;

            foreach($curso as $evaluacion){

                $alumno_curso++;

                //Obtenemos los datos del alumno
                $alumno = DB::table('participante_curso')
                    ->where([['profesor_id',$evaluacion->participante_curso_id],['curso_id',$evaluacion->curso_id]])
                    ->get();
                
                //Obtenemos numero de acreditacion de los usuarios
                if(intval($alumno[0]->acreditacion) == 1){
                    $acreditaronCurso++;
                }

                //Obtenemos y guardamos los horarios pedidos por cada usuario
                $horarios = array($evaluacion->horarios,$evaluacion->horarioi);
                array_push($horariosCurso,$horarios);

                $contestaron++;

                //Necesario para obtener el factor de recomendacion
                //En este caso necesitamos obtener el factor de recomendacion general (recomendaciones) y el individual de cada curso (recomendaciones_curso)
                if($evaluacion->p7 == 1){
                    $recomendaciones_curso++;
                    $alumnos_recomendaron_curso++;
                    $recomendaciones++;
                    $alumnosRecomendaron++;
                }else if($evaluacion->p7 == 0){
                    $alumnos_recomendaron_curso++;
                    $alumnosRecomendaron++;
                }

                //Obtenemos la cantidad de preguntas positivas del curso valor >= 60
                //De las preguntas 1_1 a 1_5 obtenemmos las evaluaciones del contenido del curso
                if($evaluacion->p1_1 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $respuestasContenido += $evaluacion->p1_1;
                    if($evaluacion->p1_1 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p1_2 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $respuestasContenido+= $evaluacion->p1_2;
                    if($evaluacion->p1_2 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p1_3 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $respuestasContenido+= $evaluacion->p1_3;
                    if($evaluacion->p1_3 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p1_4 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $respuestasContenido+= $evaluacion->p1_4;
                    if($evaluacion->p1_4 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p1_5 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $respuestasContenido+= $evaluacion->p1_5;
                    if($evaluacion->p1_5 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
    
                if($evaluacion->p2_1 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    if($evaluacion->p2_1 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p2_2 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    if($evaluacion->p2_2 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p2_3 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    if($evaluacion->p2_3 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p2_4 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    if($evaluacion->p2_4 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
    
                //De las preguntas 3_1 a 3_4 obtenemos el puntaje dado a la coordinacion
                if($evaluacion->p3_1 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $respuestasCoordinacion += $evaluacion->p3_1;
                    if($evaluacion->p3_1 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p3_2 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $respuestasCoordinacion += $evaluacion->p3_2;
                    if($evaluacion->p3_2 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p3_3 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $respuestasCoordinacion += $evaluacion->p3_3;
                    if($evaluacion->p3_3 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p3_4 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $respuestasCoordinacion += $evaluacion->p3_4;
                    if($evaluacion->p3_4 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
    
                //De la 4_1 a la 4_11 obtenemos la evaluacion del primer instructor
                //Queremos tanto el desempeño del instructor del curso como la cantidad de preguntas positivas del instructor
                if($evaluacion->p4_1 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p4_1;
                    $evaluacionProfesor++;
                    if($evaluacion->p4_1 == 1){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p4_2 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p4_2;
                    $evaluacionProfesor++;
                    if($evaluacion->p4_2 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p4_3 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p4_3;
                    $evaluacionProfesor++;
                    if($evaluacion->p4_3 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p4_4 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p4_4;
                    $evaluacionProfesor++;
                    if($evaluacion->p4_4 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p4_5 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p4_5;
                    $evaluacionProfesor++;
                    if($evaluacion->p4_5 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p4_6 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p4_6;
                    $evaluacionProfesor++;
                    if($evaluacion->p4_6 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p4_7 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p4_7;
                    $evaluacionProfesor++;
                    if($evaluacion->p4_7 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p4_8 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p4_8;
                    $evaluacionProfesor++;
                    if($evaluacion->p4_8 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p4_9 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p4_9;
                    $evaluacionProfesor++;
                    if($evaluacion->p4_9 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p4_10 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p4_10;
                    $evaluacionProfesor++;
                    if($evaluacion->p4_10 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p4_11 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p4_11;
                    $evaluacionProfesor++;
                    if($evaluacion->p4_11 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
    
                //De la 5_1 a la 5_11 obtenemos la evaluacion del segundo instructor
                //Queremos tanto el desempeño del instructor del curso como la cantidad de preguntas positivas del instructor
                if($evaluacion->p5_1 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p5_1;
                    $evaluacionProfesor++;
                    if($evaluacion->p5_1 == 1){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p5_2 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p5_2;
                    $evaluacionProfesor++;
                    if($evaluacion->p5_2 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p5_3 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p5_3;
                    $evaluacionProfesor++;
                    if($evaluacion->p5_3 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p5_4 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p5_4;
                    $evaluacionProfesor++;
                    if($evaluacion->p5_4 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p5_5 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p5_5;
                    $evaluacionProfesor++;
                    if($evaluacion->p5_5 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p5_6 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p5_6;
                    $evaluacionProfesor++;
                    if($evaluacion->p5_6 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p5_7 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p5_7;
                    $evaluacionProfesor++;
                    if($evaluacion->p5_7 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p5_8 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p5_8;
                    $evaluacionProfesor++;
                    if($evaluacion->p5_8 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p5_9 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p5_9;
                    $evaluacionProfesor++;
                    if($evaluacion->p5_9 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p5_10 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p5_10;
                    $evaluacionProfesor++;
                    if($evaluacion->p5_10 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p5_11 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p5_11;
                    $evaluacionProfesor++;
                    if($evaluacion->p5_11 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
    
                //De la 6_1 a la 6_11 obtenemos la evaluacion del tercer instructor
                //Queremos tanto el desempeño del instructor del curso como la cantidad de preguntas positivas del instructor
                if($evaluacion->p6_1 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p6_1;
                    $evaluacionProfesor++;
                    if($evaluacion->p6_1 == 1){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p6_2 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p6_2;
                    $evaluacionProfesor++;
                    if($evaluacion->p6_2 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p6_3 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p6_3;
                    $evaluacionProfesor++;
                    if($evaluacion->p6_3 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p6_4 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p6_4;
                    $evaluacionProfesor++;
                    if($evaluacion->p6_4 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p6_5 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p6_5;
                    $evaluacionProfesor++;
                    if($evaluacion->p6_5 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p6_6 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p6_6;
                    $evaluacionProfesor++;
                    if($evaluacion->p6_6 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p6_7 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p6_7;
                    $evaluacionProfesor++;
                    if($evaluacion->p6_7 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p6_8 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    if($evaluacion->p6_8 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p6_9 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p6_9;
                    $evaluacionProfesor++;
                    if($evaluacion->p6_9 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p6_10 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p6_10;
                    $evaluacionProfesor++;
                    if($evaluacion->p6_10 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
                if($evaluacion->p6_11 >= 20){
                    $preguntas++;
                    $preguntas_curso++;
                    $desempenioProfesor += $evaluacion->p6_11;
                    $evaluacionProfesor++;
                    if($evaluacion->p6_11 >= 60){
                        $positivas++;
                        $positivas_curso++;
                    }
                }
            }

            //Obtenemos factor de calidad del curso iterado, su factor de acreditacion y de recomendacion
            $factor_calidad_curso = ($positivas_curso*100)/$preguntas_curso;
            $factora_acreditacion = ($acreditaronCurso*100)/$alumno_curso;
            $factor_recomendacion_curso = ($alumnos_recomendaron_curso*100)/$recomendaciones_curso;

            //Si un curso obtiene calificacion >= 80 en cada uno de los tres factores sus profesores se vuelven a contratar
            if($factor_calidad_curso >= 80 && $factora_acreditacion >= 80 && $factor_recomendacion_curso >= 80){
                //Obtenemos los datos de los profesores del curso
                foreach($profesores as $profesors){
                    $profesor = DB::table('profesors')
                        ->where('id',$profesors->profesor_id)
                        ->get();
                    $inList = False;
                    //Buscamos no repetir profesores en la lista
                    foreach($profesoresRecontratar as $profesores){
                        if($profesores->id == $profesor[0]->id){
                            $inList = True;
                            break;
                        }
                    }
                    //Guardamos los profesores en una lista a retornar
                    if($inList == false){
                        array_push($profesoresRecontratar,$profesor[0]);
                    }
                }
            }

        }


        $factor_acreditacion = 0;
        $factor_calidad = 0;
        $promedio_coordinacion = 0;
        $promedio_contenido = 0;
        $factor_recomendacion = 0;
        $factor_instructor = 0;
        $factor_ocupacion = 0;

        //Obtenemos los factores de recomendacion
        //Necesario evitar la division entre cero, es posible pedir ver resumen de una fecha sin cursos
        if($alumnosRecomendaron != 0){
            $factor_recomendacion = round($recomendaciones*100 / $alumnosRecomendaron,2);
        }
        if($inscritos != 0){
            $factor_acreditacion = round($acreditaron*100 / $inscritos,2);
        }
        if($preguntas != 0){
            $factor_calidad = round($positivas*100 / $preguntas,2);
        }
        if($contestaron != 0){
            $promedio_coordinacion = round($respuestasCoordinacion / ($contestaron*4),2);
            $promedio_contenido = round($respuestasContenido / ($contestaron*5),2);
        }
        if($evaluacionProfesor != 0){
            $factor_instructor = round($desempenioProfesor / $evaluacionProfesor,2);
        }
        if($capacidad_total != 0){
            $factor_ocupacion = round((($inscritos*100)-1) / $capacidad_total,2);
        }

        //Si el usuario indico descargar un pdf se procedera a realizarlo
        if($pdf == 1){
            //Retornamos la funcion que permite la descarga del pdf
            return $this->descargarPDF($nombresCursos,$request,$acreditaron,$inscritos,$contestaron,$factor_ocupacion,$factor_recomendacion,$factor_acreditacion,$positivas,$DP,$DH,$CO,$DI,$Otros,$DPtematica,$DItematica,$COtematica,$DHtematica,$Otrostematica,$coordinaciones,$horarios,$promedio_coordinacion,$promedio_contenido,$profesoresRecontratar,$factor_instructor,$asistieron,$nombreCoordinacion,$lugar);
        }

        //Retornamos la vista correspondiente (seleccionados por fecah o seleccionados por fecha y coordinacion) con los datos calculados
        return view($lugar)
            ->with('nombres',$nombresCursos)
            ->with('periodo',$request)
            ->with('acreditaron',$acreditaron)
            ->with('inscritos',$inscritos)
            ->with('contestaron',$contestaron)
            ->with('factor_ocupacion',$factor_ocupacion)
            ->with('factor_ocupacion',$factor_ocupacion)
            ->with('factor_recomendacion',$factor_recomendacion)
            ->with('factor_acreditacion',$acreditaron)
            ->with('positivas',$factor_calidad)
            ->with('DP',$DP)
            ->with('DH',$DH)
            ->with('CO',$CO)
            ->with('DI',$DI)
            ->with('Otros',$Otros)
            ->with('DPtematicas',$DPtematica)
            ->with('DItematicas',$DItematica)
            ->with('COtematicas',$COtematica)
            ->with('DHtematicas',$DHtematica)
            ->with('Otrostematicas',$Otrostematica)
            ->with('coordinaciones',$coordinaciones)
            ->with('horarios',$horariosCurso)
            ->with('coordinacion',$promedio_coordinacion)
            ->with('contenido',$promedio_contenido)
            ->with('profesors',$profesoresRecontratar)
            ->with('instructor',$factor_instructor)
            ->with('asistencia',$asistieron)
            ->with('nombreCoordinacion',$nombreCoordinacion);
    }

    public function elegirFecha(){
        //Obtenemos todos los cursos y todas las coordinaciones
        $coordinaciones = Coordinacion::all();
        $cursos = DB::table('cursos')
            ->get();
            
        //Buscamos Obtener las fechas de todos los cursos
        $fechas = array();
        foreach($cursos as $curso){
            $fecha = strval($curso->semestre_anio).'-'.strval($curso->semestre_pi);
            $inList = false;
            //Iteramos los cursos para buscar su fecha
            foreach($fechas as $fechaIn){
                //Si las fechas coinciden indicamos que no se debe de ingresar el curso al arreglo
                if(strcmp($fechaIn,$fecha)==0){
                    $inList = True;
                    break;
                }
            }
            //Si no hubieron coincidencias ingresamos la fecha del curso al arreglo las fechas en que se darán los cursos
            if($inList == false){
                array_push($fechas,$fecha);
            }
        }

        return view('pages.global_fecha')
            ->with('coordinaciones',$coordinaciones)
            ->with('fechas',$fechas);
    }

    public function elegirFechaCoordinacion(){
        //Obtenemos todos los cursos y todas las coordinaciones
        $coordinaciones = Coordinacion::all();
        $cursos = DB::table('cursos')
            ->get();

        //Buscamos Obtener las fechas de todos los cursos
        $fechas = array();
        foreach($cursos as $curso){
            //Si las fechas coinciden indicamos que no se debe de ingresar el curso al arreglo
            $fecha = strval($curso->semestre_anio).'-'.strval($curso->semestre_pi);
            $inList = false;
            foreach($fechas as $fechaIn){
                if(strcmp($fechaIn,$fecha)==0){
                    $inList = True;
                    break;
                }
            }
            //Si no hubieron coincidencias ingresamos la fecha del curso al arreglo las fechas en que se darán los cursos
            if($inList == false){
                array_push($fechas,$fecha);
            }
        }
        return view('pages.global_coordinacion')
            ->with('coordinaciones',$coordinaciones)
            ->with('fechas',$fechas);
    }

    public function enviarCoordinacion(Request $request){

        //Obtenemos la fecha y la coordinacion seleccionadas por el usuario
        $semestre = $request->get('semestre');
        $fecha = explode('-',$semestre);
        $coordinacion = $request->get('coordinacion');
        $coordinaciones = DB::table('coordinacions')
            ->where('abreviatura',$coordinacion)
            ->get();

        //Buscamos los cursos de dicha coordinacion
        $catalogs = DB::table('catalogo_cursos')
            ->where('coordinacion_id',$coordinaciones[0]->id)
            ->get();
        //Buscamos los cursos de dicha fecha
        $cursosFecha = DB::table('cursos')
            ->where([['semestre_anio',$fecha[0]],['semestre_pi',$fecha[1]]])
            ->get();

        $cursos = array();
        
        //Buscamos los cursos que coinciden en fecha y coordinacion
        foreach($catalogs as $catalogo){
            foreach($cursosFecha as $curso){
                if($curso->catalogo_id == $catalogo->id){
                    array_push($cursos,$curso);
                    break;
                }
            }
        }

        //Pasamos el nombre de la coordinacion y la vista a retornar
        $nombreCoordinacion = $coordinaciones[0]->nombre_coordinacion;
        $lugar = "pages.reporte_final_area";

        return $this->enviarVista($semestre, $cursos, $nombreCoordinacion, $lugar,0);
        
    }

    public function globalPDF($fecha){
        //Obtenemos la fecha seleccionada por el usuario
        $semestre = explode('-',$fecha);

        //Obtenemos los cursos de dicha fecha
        $cursos = DB::table('cursos')
            ->where([['cursos.semestre_anio',$semestre[0]],['cursos.semestre_pi',$semestre[1]]])
            ->get();

        //Procedemos a obtener todos los datos e indicamos que queremos pasarlo a pdf
        $lugar = "pages.reporte_final_global";

        return $this->enviarVista($fecha, $cursos, "", $lugar,1);
    }

    public function areaPDF($fecha,$coordinacion){

        //Obtenemos la fecha ingresada por el usuario
        $semestre = $fecha;

        $fechaRec = explode('-',$semestre);

        //Obtenemos la coordinacion ingresada por el usuario
        $coordinacion = $coordinacion;
        $coordinaciones = DB::table('coordinacions')
            ->where('nombre_coordinacion',$coordinacion)
            ->get();

        //Obtenemos los cursos que corresponden a la coordinacion indicada
        $catalogs = DB::table('catalogo_cursos')
            ->where('coordinacion_id',$coordinaciones[0]->id)
            ->get();
        //Obtenemos los cursos que corresponden a la fecha indicada
        $cursosFecha = DB::table('cursos')
            ->where([['semestre_anio',$fechaRec[0]],['semestre_pi',$fechaRec[1]]])
            ->get();

        $cursos = array();
        
        //Buscamos los cursos que coinciden en fecha y coordinacion
        foreach($catalogs as $catalogo){
            foreach($cursosFecha as $curso){
                if($curso->catalogo_id == $catalogo->id){
                    array_push($cursos,$curso);
                    break;
                }
            }
        }

        //Procedemos a calcular los datos e indicamos que queremos descargar el pdf
        $nombreCoordinacion = $coordinaciones[0]->nombre_coordinacion;
        $lugar = "pages.reporte_final_area";

        return $this->enviarVista($semestre, $cursos, "", $lugar,1);
    }

    public function descargarPDF($nombres,$periodo,$acreditaron,$inscritos,$contestaron,$factor_ocupacion,$factor_recomendacion,$factor_acreditacion,$positivas,$DP,$DH,$CO,$DI,$Otros,$DPtematicas,$DItematicas,$COtematicas,$DHtematicas,$Otrostematicas,$coordinaciones,$horarios,$coordinacion,$contenido,$profesors,$instructor,$asistencia,$nombreCoordinacion,$lugar){
        $coordinaciones = Coordinacion::all();

        //Obtenemos el pdf con los datos calculados
        $pdf = PDF::loadView($lugar,array('nombres'=>$nombres,'periodo'=>$periodo,'acreditaron'=>$acreditaron,'inscritos'=>$inscritos,'contestaron'=>$contestaron,'factor_ocupacion'=>$factor_ocupacion,'factor_recomendacion'=>$factor_recomendacion,'factor_acreditacion'=>$factor_acreditacion,'positivas'=>$positivas,'DP'=>$DP,'DH'=>$DH,'CO'=>$CO,'DI'=>$DI,'Otros'=>$Otros,'DPtematicas'=>$DPtematicas,'DItematicas'=>$DItematicas,'COtematicas'=>$COtematicas,'DHtematicas'=>$DHtematicas,'Otrostematicas'=>$Otrostematicas,'coordinaciones'=>$coordinaciones,'horarios'=>$horarios,'coordinacion'=>$coordinacion,'contenido'=>$contenido,'profesors'=>$profesors,'instructor'=>$instructor,'asistencia'=>$asistencia,'nombreCoordinacion'=>$nombreCoordinacion));	

        //Retornamos la descarga del pdf
        return $pdf->download($lugar.'pdf');
    }

}
