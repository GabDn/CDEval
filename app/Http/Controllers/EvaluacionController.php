<?php

namespace App\Http\Controllers;
use App\Profesor;
use App\Curso;
use App\CatalogoCurso;
use App\ParticipantesCurso;
use DB;    
use App\ProfesoresCurso;
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

      $count = ProfesoresCurso::select($curso_id)
      ->where('curso_id',$curso_id)
      ->count();

      $participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
      $infoCursos = array();
      foreach($participantesCurso as $participanteCurso){
              $curso = Curso::find($participanteCurso->curso_id);
              //return $curso;
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
      ->with('infoCursos',$infoCursos)
      ->with('count',$count);
     }
     
   /*  public function enviarCorreo($profesor_id, $curso_id, $catalogoCurso_id){
          $data = array(
              'name'=>"CDEval",
          );
          Mail::send('emails.welcome',$data, function ($message) {
              $message->from('cdevalresultados@gmail.com');
              $message->to($profesor_id->email)->subject('Resultados de Encuesta');
          });
          return "Email enviado correctamente";
         
         }*/

     public function evaluacionPorSesion($profesor_id, $curso_id, $catalogoCurso_id,$count){
          $profesor = Profesor::find($profesor_id);
          $curso = Curso::find($curso_id);
          $catalogoCurso = CatalogoCurso::find($catalogoCurso_id);
          $participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
          $infoCursos = array();


          foreach($participantesCurso as $participanteCurso){
                  $curso = Curso::find($participanteCurso->curso_id);
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

         public function evaluacionPorCurso($profesor_id, $curso_id, $catalogoCurso_id,$count){
 
          $profesor = Profesor::find($profesor_id);
          $curso = Curso::find($curso_id);
          $catalogoCurso = CatalogoCurso::find($catalogoCurso_id);
          $participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
          $infoCursos = array();
        
          foreach($participantesCurso as $participanteCurso){
                  $curso = Curso::find($participanteCurso->curso_id);
                  $catalogoCursos = CatalogoCurso::find($curso->id);
                           
                   $tupla = array();
                      array_push($tupla,$curso);
                      array_push($tupla,$catalogoCursos);
                   array_push($infoCursos, $tupla);
         }
         if($catalogoCurso->tipo == "Actualizacion"){
               if($count==1){
                    return view("pages.final_seminario_1")
                    ->with("profesor",$profesor)
                    ->with("curso",$curso)
                    ->with('catalogoCurso',$catalogoCurso)
                    ->with('infoCursos',$infoCursos);
               }elseif($count==2){
                    return view("pages.final_seminario_2")
                    ->with("profesor",$profesor)
                    ->with("curso",$curso)
                    ->with('catalogoCurso',$catalogoCurso)
                    ->with('infoCursos',$infoCursos);
               }elseif($count==3){
                    return view("pages.final_seminario_3")
                    ->with("profesor",$profesor)
                    ->with("curso",$curso)
                    ->with('catalogoCurso',$catalogoCurso)
                    ->with('infoCursos',$infoCursos);
               }     
         
     }else{
          if($count==1){
               return view("pages.final_curso_1")
               ->with("profesor",$profesor)
               ->with("curso",$curso)
               ->with('catalogoCurso',$catalogoCurso)
               ->with('infoCursos',$infoCursos);
          }elseif($count==2){
               return view("pages.final_curso_2")
               ->with("profesor",$profesor)
               ->with("curso",$curso)
               ->with('catalogoCurso',$catalogoCurso)
               ->with('infoCursos',$infoCursos);
          }elseif($count==3){
               return view("pages.final_curso_3")
               ->with("profesor",$profesor)
               ->with("curso",$curso)
               ->with('catalogoCurso',$catalogoCurso)
               ->with('infoCursos',$infoCursos);
          }
          
     }         
}
//Guardar evaluaciones en la BD
//Finales
     public function saveFinal_Curso(Request $request){
          $eval_fcurso = new EvaluacionFinalCurso;
          //$promedio_p1 = new EvaluacionFinalCurso;
          //return $request->all();
          //1. DESARROLLO DEL CURSO
          $eval_fcurso->p1_1 = $request->p1_1;
          $eval_fcurso->p1_2 = $request->p1_2;
          $eval_fcurso->p1_3 = $request->p1_3;
          $eval_fcurso->p1_4 = $request->p1_4;
          $eval_fcurso->p1_5 = $request->p1_5;
          
          $promedio_p1 = [
               (int)$eval_fcurso->p1_1,
               (int)$eval_fcurso->p1_2,
               (int)$eval_fcurso->p1_3,
               (int)$eval_fcurso->p1_4,
               (int)$eval_fcurso->p1_5];
          
          //2. AUTOEVALUACION
          $eval_fcurso->p2_1 = $request->p2_1;
          $eval_fcurso->p2_2 = $request->p2_2;
          $eval_fcurso->p2_3 = $request->p2_3;
          $eval_fcurso->p2_4 = $request->p2_4;
          $promedio_p2 =[
               (int)$eval_fcurso->p2_1,
               (int)$eval_fcurso->p2_2,
               (int)$eval_fcurso->p2_3,
               (int)$eval_fcurso->p2_4 ];

          //3. COORDINACION DEL CURSO
          $eval_fcurso->p3_1 = $request->p3_1;
          $eval_fcurso->p3_2 = $request->p3_2;
          $eval_fcurso->p3_3 = $request->p3_3;
          $eval_fcurso->p3_4 = $request->p3_4;
          $promedio_p3=[
               (int)$eval_fcurso->p3_1,
               (int)$eval_fcurso->p3_2,
               (int)$eval_fcurso->p3_3,
               (int)$eval_fcurso->p3_4];

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
          $promedio_p4=[
               (int)$eval_fcurso->p4_1,
               (int)$eval_fcurso->p4_2,
               (int)$eval_fcurso->p4_3,
               (int)$eval_fcurso->p4_4,
               (int)$eval_fcurso->p4_5,
               (int)$eval_fcurso->p4_6,
               (int)$eval_fcurso->p4_7,
               (int)$eval_fcurso->p4_8,
               (int)$eval_fcurso->p4_9,
               (int)$eval_fcurso->p4_10,
               (int)$eval_fcurso->p4_11
          ];

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
          $promedio_p5=[
               (int)$eval_fcurso->p5_1,
               (int)$eval_fcurso->p5_2,
               (int)$eval_fcurso->p5_3,
               (int)$eval_fcurso->p5_4,
               (int)$eval_fcurso->p5_5,
               (int)$eval_fcurso->p5_6,
               (int)$eval_fcurso->p5_7,
               (int)$eval_fcurso->p5_8,
               (int)$eval_fcurso->p5_9,
               (int)$eval_fcurso->p5_10,
               (int)$eval_fcurso->p5_11
          ];
          //6. INSTRUCTOR TRES
          $eval_fcurso->p6_1 = $request->p6_1;
          $eval_fcurso->p6_2 = $request->p6_2;
          $eval_fcurso->p6_3 = $request->p6_3;
          $eval_fcurso->p6_4 = $request->p6_4;
          $eval_fcurso->p6_5 = $request->p6_5;
          $eval_fcurso->p6_6 = $request->p6_6;
          $eval_fcurso->p6_7 = $request->p6_7;
          $eval_fcurso->p6_8 = $request->p6_8;
          $eval_fcurso->p6_9 = $request->p6_9;
          $eval_fcurso->p6_10 = $request->p6_10;
          $eval_fcurso->p6_11 = $request->p6_11;
          $promedio_p6=[
               (int)$eval_fcurso->p6_1,
               (int)$eval_fcurso->p6_2,
               (int)$eval_fcurso->p6_3,
               (int)$eval_fcurso->p6_4,
               (int)$eval_fcurso->p6_5,
               (int)$eval_fcurso->p6_6,
               (int)$eval_fcurso->p6_7,
               (int)$eval_fcurso->p6_8,
               (int)$eval_fcurso->p6_9,
               (int)$eval_fcurso->p6_10,
               (int)$eval_fcurso->p6_11
          ];
          //7.¿RECOMENDARÍA EL CURSO A OTROS PROFESORES?
          $eval_fcurso->p7 = $request->p7;
          //8. ¿CÓMO SE ENTERÓ DEL CURSO?
          $eval_fcurso->p8 = $request->p8;
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
          $promedio=[
               (int)$eval_fcurso->p1_1,
               (int)$eval_fcurso->p1_2,
               (int)$eval_fcurso->p1_3,
               (int)$eval_fcurso->p1_4,
               (int)$eval_fcurso->p1_5,
               (int)$eval_fcurso->p2_1,
               (int)$eval_fcurso->p2_2,
               (int)$eval_fcurso->p2_3,
               (int)$eval_fcurso->p2_4,
               (int)$eval_fcurso->p3_1,
               (int)$eval_fcurso->p3_2,
               (int)$eval_fcurso->p3_3,
               (int)$eval_fcurso->p3_4,
               (int)$eval_fcurso->p4_1,
               (int)$eval_fcurso->p4_2,
               (int)$eval_fcurso->p4_3,
               (int)$eval_fcurso->p4_4,
               (int)$eval_fcurso->p4_5,
               (int)$eval_fcurso->p4_6,
               (int)$eval_fcurso->p4_7,
               (int)$eval_fcurso->p4_8,
               (int)$eval_fcurso->p4_9,
               (int)$eval_fcurso->p4_10,
               (int)$eval_fcurso->p4_11,
               (int)$eval_fcurso->p5_1,
               (int)$eval_fcurso->p5_2,
               (int)$eval_fcurso->p5_3,
               (int)$eval_fcurso->p5_4,
               (int)$eval_fcurso->p5_5,
               (int)$eval_fcurso->p5_6,
               (int)$eval_fcurso->p5_7,
               (int)$eval_fcurso->p5_8,
               (int)$eval_fcurso->p5_9,
               (int)$eval_fcurso->p5_10,
               (int)$eval_fcurso->p5_11
               ];
          $pg=collect($promedio)->average()*2*10;
          $p1=collect($promedio_p1)->average()*2*10;
          $p2=collect($promedio_p2)->average()*2*10;
          $p3=collect($promedio_p3)->average()*2*10;
          $p4=collect($promedio_p4)->average()*2*10;
          $p5=collect($promedio_p5)->average()*2*10;
          //$avp1=
          
          return 'Registrado --->        P1: '.$p1.'      P2: '.$p2.'       P3: '.$p3.'        P4: '.$p4.'         P5: '.$p5.'         PG: '.$pg;
          //$avg_p1 = DB::table('_evaluacion_final_curso') ->avg((int)'p1_1'+(int)'p1_2'+(int)'p1_3'+(int)'p1_4'+(int)'p1_5');
          //return $avg_p1;
          return "Registrado";
     }

     public function saveFinal_Seminario(Request $request){
          $eval_fseminario = new EvaluacionFinalSeminario;
          $promedio_p1 = new EvaluacionFinalSeminario;
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
          //5. INSTRUCTOR DOS
          $eval_fseminario->p5_1 = $request->p5_1;
          $eval_fseminario->p5_2 = $request->p5_2;
          $eval_fseminario->p5_3 = $request->p5_3;
          $eval_fseminario->p5_4 = $request->p5_4;
          $eval_fseminario->p5_5 = $request->p5_5;
          $eval_fseminario->p5_6 = $request->p5_6;
          $eval_fseminario->p5_7 = $request->p5_7;
          $eval_fseminario->p5_8 = $request->p5_8;
          $eval_fseminario->p5_9 = $request->p5_9;
          $eval_fseminario->p5_10 = $request->p5_10;
          $eval_fseminario->p5_11 = $request->p5_11;
          $promedio_p5=[
               (int)$eval_fseminario->p5_1,
               (int)$eval_fseminario->p5_2,
               (int)$eval_fseminario->p5_3,
               (int)$eval_fseminario->p5_4,
               (int)$eval_fseminario->p5_5,
               (int)$eval_fseminario->p5_6,
               (int)$eval_fseminario->p5_7,
               (int)$eval_fseminario->p5_8,
               (int)$eval_fseminario->p5_9,
               (int)$eval_fseminario->p5_10,
               (int)$eval_fseminario->p5_11
          ];
          //6. INSTRUCTOR TRES
          $eval_fseminario->p6_1 = $request->p6_1;
          $eval_fseminario->p6_2 = $request->p6_2;
          $eval_fseminario->p6_3 = $request->p6_3;
          $eval_fseminario->p6_4 = $request->p6_4;
          $eval_fseminario->p6_5 = $request->p6_5;
          $eval_fseminario->p6_6 = $request->p6_6;
          $eval_fseminario->p6_7 = $request->p6_7;
          $eval_fseminario->p6_8 = $request->p6_8;
          $eval_fseminario->p6_9 = $request->p6_9;
          $eval_fseminario->p6_10 = $request->p6_10;
          $eval_fseminario->p6_11 = $request->p6_11;
          $promedio_p6=[
               (int)$eval_fseminario->p6_1,
               (int)$eval_fseminario->p6_2,
               (int)$eval_fseminario->p6_3,
               (int)$eval_fseminario->p6_4,
               (int)$eval_fseminario->p6_5,
               (int)$eval_fseminario->p6_6,
               (int)$eval_fseminario->p6_7,
               (int)$eval_fseminario->p6_8,
               (int)$eval_fseminario->p6_9,
               (int)$eval_fseminario->p6_10,
               (int)$eval_fseminario->p6_11
          ];
          //6.¿RECOMENDARÍA EL CURSO A OTROS PROFESORES?
          $eval_fseminario->p7 = $request->p7;
          //7. ¿CÓMO SE ENTERÓ DEL CURSO?
          $eval_fseminario->p8 = $request->p8;

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
          $promedio_p1 = [
               (int)$eval_fseminario->p1_1,
               (int)$eval_fseminario->p1_2,
               (int)$eval_fseminario->p1_3,
               (int)$eval_fseminario->p1_4,
               (int)$eval_fseminario->p1_5];
$promedio_p2 =[
               (int)$eval_fseminario->p2_1,
               (int)$eval_fseminario->p2_2,
               (int)$eval_fseminario->p2_3,
               (int)$eval_fseminario->p2_4];
 $promedio_p3=[
               (int)$eval_fseminario->p3_1,
               (int)$eval_fseminario->p3_2,
               (int)$eval_fseminario->p3_3,
               (int)$eval_fseminario->p3_4];
$promedio_p4=[
               (int)$eval_fseminario->p4_1,
               (int)$eval_fseminario->p4_2,
               (int)$eval_fseminario->p4_3,
               (int)$eval_fseminario->p4_4,
               (int)$eval_fseminario->p4_5,
               (int)$eval_fseminario->p4_6,
               (int)$eval_fseminario->p4_7,
               (int)$eval_fseminario->p4_8,
               (int)$eval_fseminario->p4_9,
               (int)$eval_fseminario->p4_10,
               (int)$eval_fseminario->p4_11];
               $promedio=[
               (int)$eval_fseminario->p1_1,
               (int)$eval_fseminario->p1_2,
               (int)$eval_fseminario->p1_3,
               (int)$eval_fseminario->p1_4,
               (int)$eval_fseminario->p1_5,
               (int)$eval_fseminario->p2_1,
               (int)$eval_fseminario->p2_2,
               (int)$eval_fseminario->p2_3,
               (int)$eval_fseminario->p2_4,
               (int)$eval_fseminario->p3_1,
               (int)$eval_fseminario->p3_2,
               (int)$eval_fseminario->p3_3,
               (int)$eval_fseminario->p3_4,
               (int)$eval_fseminario->p4_1,
               (int)$eval_fseminario->p4_2,
               (int)$eval_fseminario->p4_3,
               (int)$eval_fseminario->p4_4,
               (int)$eval_fseminario->p4_5,
               (int)$eval_fseminario->p4_6,
               (int)$eval_fseminario->p4_7,
               (int)$eval_fseminario->p4_8,
               (int)$eval_fseminario->p4_9,
               (int)$eval_fseminario->p4_10,
               (int)$eval_fseminario->p4_11
               ];

          $p1=collect($promedio_p1)->average()*2*10;
          $p2=collect($promedio_p2)->average()*2*10;
          $p3=collect($promedio_p3)->average()*2*10;
          $p4=collect($promedio_p4)->average()*2*10;
          $pg=collect($promedio)->average()*2*10;

          return 'Registrado --->        P1: '.$p1.'      P2: '.$p2.'       P3: '.$p3.'        P4: '.$p4.'       PG:'.$pg;
          return "Registrado";
     }
     
//Por sesiones
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
          $promedio=[
               (int)$eval_xcurso->p1,
               (int)$eval_xcurso->p2,
               (int)$eval_xcurso->p3,
               (int)$eval_xcurso->p4,
               (int)$eval_xcurso->p5,
               (int)$eval_xcurso->p6,
               (int)$eval_xcurso->p7
          ];
          $pg=collect($promedio)->average()*2*10;
          return 'Registrado --->       PG:'.$pg;
          return "Registrado";
     }

     public function saveXSeminario(Request $request){
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
