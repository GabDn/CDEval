<?php

namespace App\Http\Controllers;
use App\Profesor;
use App\Curso;
use App\CatalogoCurso;
use App\ParticipantesCurso;

use App\EvaluacionFinalCurso;
use App\EvaluacionFinalSeminario;
use App\EvaluacionXCurso;
use App\EvaluacionXSeminario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EvaluacionController extends Controller{


     public function index($profesor_id, $curso_id, $catalogoCurso_id){
 
      $profesor = Profesor::find($profesor_id);
      $curso = Curso::find($curso_id);
      $catalogoCurso = CatalogoCurso::find($catalogoCurso_id);

      $participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
      $infoCursos = array();
      foreach($participantesCurso as $participanteCurso){
              $curso = Curso::find($participanteCurso->id);
              $catalogoCursos = CatalogoCurso::find($curso->id);
                       
               $tupla = array();
                  array_push($tupla,$curso);
                  array_push($tupla,$catalogoCursos);
               array_push($infoCursos, $tupla);
     }
      return view("pages.evaluacionIndex")
      ->with("profesor",$profesor)
      ->with("curso",$curso)
      ->with('catalogoCurso',$catalogoCurso)
      ->with('infoCursos',$infoCursos);
     }
     
     public function enviarCorreo($profesor_id, $curso_id, $catalogoCurso_id){
          $data = array(
              'name'=>"CDEval",
          );
          Mail::send('emails.welcome',$data, function ($message) {
              $message->from('cdevalresultados@gmail.com');
              $message->to($profesor_id->email)->subject('Resultados de Encuesta');
          });
          return "Email enviado correctamente";
         
         }





     public function evaluacionPorSesion($profesor_id, $curso_id, $catalogoCurso_id){
          
          $profesor = Profesor::find($profesor_id);
          $curso = Curso::find($curso_id);
          $catalogoCurso = CatalogoCurso::find($catalogoCurso_id);
          $participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
          $infoCursos = array();
          foreach($participantesCurso as $participanteCurso){
                  $curso = Curso::find($participanteCurso->id);
                  $catalogoCursos = CatalogoCurso::find($curso->id);
                           
                   $tupla = array();
                      array_push($tupla,$curso);
                      array_push($tupla,$catalogoCursos);
                   array_push($infoCursos, $tupla);
         }
               if($catalogoCurso->tipo == "Actualizacion"){
                    return view("pages.xsesion_seminario")
                    ->with("profesor",$profesor)
                    ->with("curso",$curso)
                    ->with('catalogoCurso',$catalogoCurso)
                    ->with('infoCursos',$infoCursos);
                   
               }else{
                    return view("pages.xsesion")
                    ->with("profesor",$profesor)
                    ->with("curso",$curso)
                    ->with('catalogoCurso',$catalogoCurso)
                    ->with('infoCursos',$infoCursos);
               }
               
         }

         public function evaluacionPorCurso($profesor_id, $curso_id, $catalogoCurso_id){
 
          $profesor = Profesor::find($profesor_id);
          $curso = Curso::find($curso_id);
          $catalogoCurso = CatalogoCurso::find($catalogoCurso_id);
          $participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
          $infoCursos = array();
          foreach($participantesCurso as $participanteCurso){
                  $curso = Curso::find($participanteCurso->id);
                  $catalogoCursos = CatalogoCurso::find($curso->id);
                           
                   $tupla = array();
                      array_push($tupla,$curso);
                      array_push($tupla,$catalogoCursos);
                   array_push($infoCursos, $tupla);
         }
         if($catalogoCurso->tipo == "Actualizacion"){
          return view("pages.final_seminario")
          ->with("profesor",$profesor)
          ->with("curso",$curso)
          ->with('catalogoCurso',$catalogoCurso)
          ->with('infoCursos',$infoCursos);
         
     }else{
          return view("pages.final_curso")
          ->with("profesor",$profesor)
          ->with("curso",$curso)
          ->with('catalogoCurso',$catalogoCurso)
          ->with('infoCursos',$infoCursos);
     }         }
//Lo que debe de contener cada tabla

     public function saveFinal_Curso(Request $request){
          $eval_fcurso = new EvaluacionFinalCurso;
          return $request->all();
          //1. DESARROLLO DEL CURSO
          $eval_fcurso->p1_1 = $request->p1_1;
          $eval_fcurso->p1_2 = $request->p1_2;
          $eval_fcurso->p1_3 = $request->p1_3;
          $eval_fcurso->p1_4 = $request->p1_4;
          $eval_fcurso->p1_5 = $request->p1_5;
          //2. AUTOEVALUACION
          $eval_fcurso->p2_1 = $request->p2_1;
          $eval_fcurso->p2_2 = $request->p2_2;
          $eval_fcurso->p2_3 = $request->p2_3;
          $eval_fcurso->p2_4 = $request->p2_4;
          //3. COORDINACION DEL CURSO
          $eval_fcurso->p3_1 = $request->p3_1;
          $eval_fcurso->p3_2 = $request->p3_2;
          $eval_fcurso->p3_3 = $request->p3_3;
          $eval_fcurso->p3_4 = $request->p3_4;
          //4. INSTRUCTOR UNO
          $eval_fcurso->p4_1 = $request->p4_1;
          $eval_fcurso->p4_2 = $request->p4_2;
          $eval_fcurso->p4_3 = $request->p4_3;
          $eval_fcurso->p4_4 = $request->p4_4;
          $eval_fcurso->p4_5 = $request->p4_5;
          $eval_fcurso->p4_6 = $request->p4_6;
          $eval_fcurso->p4_7 = $request->p4_7;
          $eval_fcurso->p4_8 = $request->p4_8;
          $eval_fcurso->p4_9 = $request->p4_9;
          $eval_fcurso->p4_10 = $request->p4_10;
          $eval_fcurso->p4_11 = $request->p4_11;
          //5. INSTRUCTOR DOS
          $eval_fcurso->p5_1 = $request->p5_1;
          $eval_fcurso->p5_2 = $request->p5_2;
          $eval_fcurso->p5_3 = $request->p5_3;
          $eval_fcurso->p5_4 = $request->p5_4;
          $eval_fcurso->p5_5 = $request->p5_5;
          $eval_fcurso->p5_6 = $request->p5_6;
          $eval_fcurso->p5_7 = $request->p5_7;
          $eval_fcurso->p5_8 = $request->p5_8;
          $eval_fcurso->p5_9 = $request->p5_9;
          $eval_fcurso->p5_10 = $request->p5_10;
          $eval_fcurso->p5_11 = $request->p5_11;
          //6.¿RECOMENDARÍA EL CURSO A OTROS PROFESORES?
          $eval_fcurso->p6 = $request->p6;
          //7. ¿CÓMO SE ENTERÓ DEL CURSO?
          $eval_fcurso->p7 = $request->p7;
          //Lo mejor del curso fue:
          $eval_fcurso->mejor = $request->mejor;
          //Sugerencias y recomendaciones:	
          $eval_fcurso->sug = $request->sug;
          //¿Qué otros cursos, talleres, seminarios o temáticos le gustaría que se impartiesen o tomasen en cuenta para próximas actividades?
          $eval_fcurso->otros = $request->otros;
          //ÁREA DE CONOCIMIENTO
          $eval_fcurso->conocimiento = $request->conocimiento;
          //Temáticas:	
          $eval_fcurso->tematica = $request->tematica;
          //¿En qué horarios le gustaría que se impartiesen los cursos, talleres, seminarios o diplomados?
          //Horarios Semestrales:
          $eval_fcurso->horarios = $request->horarios;	
          //Horarios Intersemestrales:
          $eval_fcurso->horarioi = $request->horarioi;
          $eval_fcurso->save();
          return "Registrado";
     }

     public function saveFinal_Seminario(Request $request){
          $eval_fseminario = new EvaluacionFinalSeminario;
          //return $request;
          //return view(pages.final_seminario);
          //1. DESARROLLO DEL CURSO
          $eval_fseminario->p1_1 = $request->p1_1;
          $eval_fseminario->p1_2 = $request->p1_2;
          $eval_fseminario->p1_3 = $request->p1_3;
          $eval_fseminario->p1_4 = $request->p1_4;
          $eval_fseminario->p1_5 = $request->p1_5;
          //2. AUTOEVALUACION
          $eval_fseminario->p2_1 = $request->p2_1;
          $eval_fseminario->p2_2 = $request->p2_2;
          $eval_fseminario->p2_3 = $request->p2_3;
          $eval_fseminario->p2_4 = $request->p2_4;
          //3. COORDINACION DEL CURSO
          $eval_fseminario->p3_1 = $request->p3_1;
          $eval_fseminario->p3_2 = $request->p3_2;
          $eval_fseminario->p3_3 = $request->p3_3;
          $eval_fseminario->p3_4 = $request->p3_4;
          //4. FACILITADOR(A) DEL SEMINARIO
          $eval_fseminario->p4_1 = $request->p4_1;
          $eval_fseminario->p4_2 = $request->p4_2;
          $eval_fseminario->p4_3 = $request->p4_3;
          $eval_fseminario->p4_4 = $request->p4_4;
          $eval_fseminario->p4_5 = $request->p4_5;
          $eval_fseminario->p4_6 = $request->p4_6;
          $eval_fseminario->p4_7 = $request->p4_7;
          $eval_fseminario->p4_8 = $request->p4_8;
          $eval_fseminario->p4_9 = $request->p4_9;
          $eval_fseminario->p4_10 = $request->p4_10;
          $eval_fseminario->p4_11 = $request->p4_11;
          //5.¿RECOMENDARÍA EL CURSO A OTROS PROFESORES?
          $eval_fseminario->p5 = $request->p5;
          //6. ¿CÓMO SE ENTERÓ DEL SEMINARIO?
          $eval_fseminario->p6 = $request->p6;
          //Lo que me aportó el seminario fue:
          $eval_fseminario->aporto = $request->aporto;
          //Sugerencias y recomendaciones:	
          $eval_fseminario->sug = $request->sug;
          //¿Qué otros cursos, talleres, seminarios o temáticos le gustaría que se impartiesen o tomasen en cuenta para próximas actividades?
          $eval_fseminario->otros = $request->otros;
          //ÁREA DE CONOCIMIENTO
          $eval_fseminario->conocimiento = $request->conocimiento;
          //Temáticas:	
          $eval_fseminario->tematica = $request->tematica;
          //¿En qué horarios le gustaría que se impartiesen los cursos, talleres, seminarios o diplomados?
          //Horarios Semestrales:
          $eval_fseminario->horarios = $request->horarios;	
          //Horarios Intersemestrales:
          $eval_fseminario->horarioi = $request->horarioi;
          $eval_fseminario->save();
          return "Registrado";
     }
     

     public function saveXCurso(Request $request){
          $eval_xcurso = new EvaluacionXCurso;
          $eval_xcurso->p1=$request->p1;
          $eval_xcurso->p2=$request->p2;
          $eval_xcurso->p3=$request->p3;
          $eval_xcurso->p4=$request->p4;
          $eval_xcurso->p5=$request->p5;
          $eval_xcurso->p6=$request->p6;
          $eval_xcurso->p7=$request->p7;
          $eval_xcurso->contenido=$request->contenido;
          $eval_xcurso->sug=$request->sug;
          $eval_xcurso->save();
          return "Registrado";
     }

     public function saveXSeminario(Request $request){
          //return $request;
          
          $eval_xseminario = new EvaluacionXSeminario;
          $eval_xseminario->p1=$request->p1;
          $eval_xseminario->p1_arg=$request->p1_arg;
          $eval_xseminario->p2=$request->p2;
          $eval_xseminario->p2_arg=$request->p2_arg;
          $eval_xseminario->p3=$request->p3;
          $eval_xseminario->p3_arg=$request->p3_arg;
          $eval_xseminario->p4=$request->p4;
          $eval_xseminario->p4_arg=$request->p4_arg;
          $eval_xseminario->p5=$request->p5;
          $eval_xseminario->p5_arg=$request->p5_arg;
          $eval_xseminario->save();
          return "Registrado";
          
     }
       

}
