<style>
    div.container {
        text-align:center;
    }
html{
	width:100%;
}
body {
  font-family: Arial, Helvetica, Sans-serif;
  align-items: center;
  font-size: 15px;
}
.f{
    background-color: #2A4EDF;
    color: white; 
}
.n{
    border: 0px solid white;
}
.n1{
    border: 0px solid white;
    padding-left:3em;
}
#mayusculas{
	text-transform: uppercase;
}
#h4 {
    margin:15px 60px 15px; 
}
#renglonDoble, #mayusculas{
	 border: 1px solid white;
}
#normal, td,#encabezado{
  border: 1px solid #000;
  border-spacing: 0;
}
#encabezado{
	/*padding: 10px;*/
}
.small{
	width: 20%;
}
</style>
@extends('layouts.app')

@section('contenido')

<div class="content">
    <div class="top-bar">       
      <a href="#menu" class="side-menu-link burger"> 
        <span class='burger_inside' id='bgrOne'></span>
        <span class='burger_inside' id='bgrTwo'></span>
        <span class='burger_inside' id='bgrThree'></span>
      </a>      
    </div>
    <section class="content-inner">
    <br>
      <div class="panel panel-default">

        <div class="panel-heading">
              <h3>Evaluación Global</h3>
              
              
              <div class="input-group">
    
                  
              </div>
          </div>

                <div class="panel-body">
                <div>
        <table width="100%">
            <tr>
                <th class="thead-light">1. DATOS GENERALES DEL {{strtoupper($nombre)}}</th>
            </tr>
            <tr>
                <td style="font-weight: bold; border: 0px solid white;">a) Instructor</td>
                <?php
                    foreach($nombreInstructor as $instructorCurso){
                        echo "<td style=\"border: 0px solid white;\">$instructorCurso->nombres $instructorCurso->apellido_paterno $instructorCurso->apellido_materno,</td>";
                    }
                ?>
            </tr>
            <tr>
                <td style="font-weight: bold; border: 0px solid white;">b) Fecha de impartición</td>
                <td style="border: 0px solid white;">{{$curso->fecha_inicio}}, {{$curso->fecha_fin}}</td>
                <td style="font-weight: bold; border: 0px solid white;">e) Capacidad</td>
                <td style="border: 0px solid white;">{{$curso->cupo_maximo}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; border: 0px solid white;">c) Horario</td>
                <td style="border: 0px solid white;">{{$curso->hora_inicio}}, {{$curso->hora_fin}}</td>
                <td style="font-weight: bold; border: 0px solid white;">f) Total de horas</td>
                <td style="border: 0px solid white;">{{$numero_horas}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold" class="n">d) Lugar</td>
                <td style="border: 0px solid white;">{{$salon->sede}}</td>
                
            </tr>     
        </table>
        <br> <hr>
        <table width="100%">
            <tr>
                <th>2. REGISTRO DE PARTICIPANTES</th>
            </tr>
            <tr>
                <td style="font-weight: bold; border: 0px solid white;">a) Inscritos</td>
                <td style="border: 0px solid white;"><?php echo sizeof($participantes); ?></td>
                <td style="font-weight: bold ; margin-left: 50px white;" class="n" >c) Acreditaron</td>
                <td style="border: 0px solid white;">{{$acreditaron}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; border: 0px solid white;">b) Asistieron</td>
                <td style="border: 0px solid white;">{{$asistieron}}</td>
                <td style="font-weight: bold ; margin-left: 50px white;" class="n">d) Formato de evaluación</td>
                <td style="border: 0px solid white;">{{$contestaron}}</td>
            </tr>
        </table>
        <br> <hr>
        <table width="100%">
            <tr>
                <th>3. FACTOR DE OCUPACIÓN</th>
                <td style="border: 0px solid white;"> {{$ocupacion}}</td>
                <th> 4. FACTOR DE RECOMENDACIÓN</th>
                <td style="border: 0px solid white;"> {{$factor}}</td>
            </tr>
        </table>
        <br>
        <table width="100%">
            <tr>
                <th>5. FACTOR DE ACREDITACIÓN</th>
                <td style="border: 0px solid white;"> {{$factor_acreditacion}}</td>
                <th>6. FACTOR DE CALIDAD</th>
                <td style="border: 0px solid white;"> {{$positivas}}</td>
            </tr>
        </table>
        <br> <hr>

        <div id = "Dato">
            <table width="100%">
                <tr>
                    <th>7. FACTOR DE DESEMPEÑO INSTRUCTORES</th>
                </tr>
            </table>
            <table width="100%">
                <tr>
                    <th style="background-color: #2A4EDF;color: white; ">Instructor</th>
                    <th style="background-color: #2A4EDF;color: white; ">Promedio</th>
                    <th style="background-color: #2A4EDF;color: white; ">Mínimo</th>
                    <th style="background-color: #2A4EDF;color: white; ">Máximo</th>
                </tr>
                <tr>
                    <td style="border: 0px solid white;">{{$nombreInstructor[0]->nombres}} {{$nombreInstructor[0]->apellido_paterno}} {{$nombreInstructor[0]->apellido_materno}}</td>
                    <td style="border: 0px solid white;">{{$instructor}}</td>
                    <td style="border: 0px solid white;">{{$minimo}}</td>
                    <td style="border: 0px solid white;">{{$maximo}}</td>
                </tr>
            </table>
            <table width="100%">
                <tr>
                    <th style="background-color: #2A4EDF;color: white; ">Instructor</th>
                    <th style="background-color: #2A4EDF;color: white; ">Promedio</th>
                    <th style="background-color: #2A4EDF;color: white; ">Mínimo</th>
                    <th style="background-color: #2A4EDF;color: white; ">Máximo</th>
                </tr>
                <tr>
                    <td style="border: 0px solid white;">{{$nombreInstructor[1]->nombres}} {{$nombreInstructor[1]->apellido_paterno}} {{$nombreInstructor[1]->apellido_materno}}</td>
                    <td style="border: 0px solid white;">{{$instructor2}}</td>
                    <td style="border: 0px solid white;">{{$minimo2}}</td>
                    <td style="border: 0px solid white;">{{$maximo2}}</td>
                </tr>
            </table>
        </div>

        <br>
        <table width="100%">
            <tr>
                <th>8. JUICIO SUMARIO  INSTRUCTOR a)</th>
                <?php
                    if($factor >= 80){
                        echo "<td style=\"border: 0px solid white;\">Si</td>";
                    }else{
                        echo "<td style=\"border: 0px solid white;\">No</td>";
                    }
                ?>
            </tr>
            <tr>
                <th>8. JUICIO SUMARIO  CURSO b)</th>
                <?php
                    if($factor >= 80 && $factor_acreditacion >= 80 && $positivas >= 80){
                        echo "<td style=\"border: 0px solid white;\">Si</td>";
                    }else{
                        echo "<td style=\"border: 0px solid white;\">No</td>";
                    }
                ?>
            </tr>
        </table>
        <br> <hr>
        <table>
            <tr>
                <th>9. RECOMENDACIONES</th>
            </tr>
            <?php
                foreach($evals as $evaluacion){
                    echo "<tr>";
                    echo "<td style=\"border: 0px solid white; padding-left:3em;\">$evaluacion->sug</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <br> <hr>
        <table width="100%">
            <tr>
                <th>10. ÁREAS SOLICITADAS</th>
                <th>DP: </th>
                <td style="border: 0px solid white;">{{$DP}}</td>
                <th>DH: </th>
                <td style="border: 0px solid white;">{{$DH}}</td>
                <th>CO: </th>
                <td style="border: 0px solid white;">{{$CO}}</td>
                <th>DI: </th>
                <td style="border: 0px solid white;">{{$DI}}</td>
                <th>Otros: </th>
                <td style="border: 0px solid white;">{{$Otros}}</td>
            </tr>
        </table>
        <br> <hr>
        <table>
            <tr>
                <th>11. TEMÁTICA SOLICITADAS</th>
            </tr>
            <?php
                foreach($evals as $evaluacion){
                    echo "<tr>";
                    echo "<td style=\"border: 0px solid white; padding-left:3em;\">$evaluacion->tematica</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <br> <hr>
        <table width="100%">
            <tr>
                <th>12. HORARIOS SOLICITADOS</th>
            </tr>
            <?php
                foreach($evals as $evaluacion){
                    echo "<tr>";
                    echo "<td style=\"border: 0px solid white; padding-left:3em;\">$evaluacion->horarios</td>";
                    echo "<td style=\"border: 0px solid white; padding-left:3em;\">$evaluacion->horarioi</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <br> <hr>
        <div id = "Instructor">
            <table width="100%">
                <tr>
                    <th>13. CRITERIOS DE ACEPTACION</th>
                </tr>
                <tr>
                    <td style="border: 0px solid white;"> Contenido: {{$contenido}}</td>
                    <td style="border: 0px solid white;"> Instructores: <?php echo round(($instructor+$instructor2)/2,2)?></td>
                    <td style="border: 0px solid white;"> Coordinacion: {{$factor_coordinacion}}</td>
                    <td style="border: 0px solid white;"> Recomendacion: {{$factor}}</td>
                </tr>
            </table>
        </div>
    </div>

    <button id="dia"  type="button" class="btn btn-primary active"><a href="{{route('ver.global.final',['curso_id'=>$curso_id,'pdf'=>1,'encargado_id'=>$encargado_id])}}" style="color:white">Descargar PDF</a></button>

                         
                </div>
     </section>
@endsection