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
                <th class="thead-light">1. DATOS GENERALES DEL CURSO</th>
            </tr>
            <tr>
                <td style="font-weight: bold" class="n">a) Instructor</td>
                <td class="n"> Juan Ramirez Gonzales</td>
            </tr>
            <tr>
                <td style="font-weight: bold" class="n">b) Fecha de impartición</td>
                <td class="n">{{$curso->fecha_inicio}}, {{$curso->fecha_fin}}</td>
                <td style="font-weight: bold ; margin-left: 50px white;" class="n" >e) Capacidad</td>
                <td class="n">{{$curso->cupo_maximo}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold" class="n">c) Horario</td>
                <td class="n">{{$curso->hora_inicio}}, {{$curso->hora_fin}}</td>
                <td style="font-weight: bold ; margin-left: 50px white;" class="n">f) Total de horas</td>
                <td class="n">{{$numero_horas}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold" class="n">d) Lugar</td>
                <td class="n">{{$salon->sede}}</td>
                
            </tr>     
        </table>
        <br> <hr>
        <table width="100%">
            <tr>
                <th>2. REGISTRO DE PARTICIPANTES</th>
            </tr>
            <tr>
                <td style="font-weight: bold" class="n">a) Inscritos</td>
                <td class="n">{{$participantes}}</td>
                <td style="font-weight: bold ; margin-left: 50px white;" class="n" >c) Acreditaron</td>
                <td class="n">{{$acreditaron}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold" class="n">b) Asistieron</td>
                <td class="n">1</td>
                <td style="font-weight: bold ; margin-left: 50px white;" class="n">d) Formato de evaluación</td>
                <td class="n">1</td>
            </tr>
        </table>
        <br> <hr>
        <table width="100%">
            <tr>
                <th>3. FACTOR DE OCUPACIÓN</th>
                <td class="n"> {{$ocupacion}}</td>
                <th> 4. FACTOR DE RECOMENDACIÓN</th>
                <td class="n"> {{$factor}}</td>
            </tr>
        </table>
        <br>
        <table width="100%">
            <tr>
                <th>5. FACTOR DE ACREDITACIÓN</th>
                <td class="n"> {{$factor_acreditacion}}</td>
                <th>6. FACTOR DE CALIDAD</th>
                <td class="n"> {{$positivas}}</td>
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
                    <th class="f">Instructor</th>
                    <th class="f">Promedio</th>
                    <th class="f">Mínimo</th>
                    <th class="f">Máximo</th>
                </tr>
                <tr>
                    <td class="n">INSTRUCTOR</td>
                    <td class="n">{{$instructor}}</td>
                    <td class="n">{{$minimo}}</td>
                    <td class="n">{{$maximo}}</td>
                </tr>
            </table>
        </div>

        <br>
        <table width="100%">
            <tr>
                <th>8. JUICIO SUMARIO  INSTRUCTOR a)</th>
                <?php
                    if($factor >= 80){
                        echo "<td class=\"n\">Si</td>";
                    }else{
                        echo "<td class=\"n\">No</td>";
                    }
                ?>
            </tr>
            <tr>
                <th>8. JUICIO SUMARIO  CURSO b)</th>
                <?php
                    if($factor >= 80 && $factor_acreditacion >= 80 && positivas >= 80){
                        echo "<td class=\"n\">Si</td>";
                    }else{
                        echo "<td class=\"n\">No</td>";
                    }
                ?>
            </tr>
        </table>
        <br> <hr>
        <table>
            <tr>
                <th>9. RECOMENDACIONES</th>
            </tr>
            <tr>
                <?php
                    foreach($evals as $evaluacion){
                        echo "<tr>";
                        echo "<td class=\"n1\">$evaluacion->sug</td>";
                        echo "</tr>";
                    }
                ?>
            </tr>
        </table>
        <br> <hr>
        <table width="100%">
            <tr>
                <th>10. ÁREAS SOLICITADAS</th>
                <th>DP: </th>
                <td class="n">{{$DP}}</td>
                <th>DH: </th>
                <td class="n">{{$DH}}</td>
                <th>CO: </th>
                <td class="n">{{$CO}}</td>
                <th>DI: </th>
                <td class="n">{{$DI}}</td>
                <th>Otros: </th>
                <td class="n">{{$Otros}}</td>
            </tr>
        </table>
        <br> <hr>
        <table>
            <tr>
                <th>11. TEMÁTICA SOLICITADAS</th>
            </tr>
            <tr>
                <?php
                    foreach($evals as $evaluacion){
                        echo "<tr>";
                        echo "<td class=\"n1\">$evaluacion->tematica</td>";
                        echo "</tr>";
                    }
                ?>
            </tr>
        </table>
        <br> <hr>
        <table width="100%">
            <tr>
                <th>12. HORARIOS SOLICITADOS</th>
            </tr>
            <tr>
                <?php
                        foreach($evals as $evaluacion){
                            echo "<tr>";
                            echo "<td class=\"n1\">$evaluacion->horarios</td>";
                            echo "<td class=\"n1\">$evaluacion->horarioi</td>";
                            echo "</tr>";
                        }
                ?>
            </tr>
        </table>
        <br> <hr>
        <div id = "Instructor">
            <table width="100%">
                <tr>
                    <th>13. CRITERIOS DE ACEPTACION</th>
                </tr>
                <tr>
                    <td class="n"> Contenido: {{$contenido}}</td>
                    <td class="n"> Instructores: {{$instructor}}</td>
                    <td class="n"> Coordinacion: {{$coordinacion}}</td>
                    <td class="n"> Recomendacion: {{$factor}}</td>
                </tr>
            </table>
        </div>
        <!---<div id = "No instructor">
            <table width="100%">
                <tr>
                    <th>13. CRITERIOS DE ACEPTACION</th>
                </tr>
                <tr>
                    <td class="n"> Contenido: {{$contenido}}</td>
                    <td class="n"> Coordinacion: {{$coordinacion}}</td>
                    <td class="n"> Recomendacion: {{$factor}}</td>
                </tr>
            </table>
        </div>-->
    </div>

                         
                </div>
     </section>

<!--<script>
    if({{$instructor}} == 0){
		document.getElementById("Dato").style.visibility = "hidden"; // deshabilitar
        document.getElementById("Instructor").style.visibility = "hidden";
        console.log('Se deshabilito');
    }else{
        document.getElementById("No instructor").style.visibility = "hidden";
    }
    console.log('raro');
</script>-->
@endsection