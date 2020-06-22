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
              <h3>AREA DE FORMACION Y DESARROLLO DEL DOSCENTE</h3>

              <h4>{{$nombreCoordinacion}}</h4>
              
              
              <div class="input-group">
    
                  
              </div>
          </div>

                <div class="panel-body">
                <div>
        <br> <hr>
        <table width="100%">
            <tr>
                <th>NOMBRE DE LOS CURSOS EVALUADOS</th>
            </tr>
            <tr>
                <td style="border: 0px solid white;">
                    <ul>
                        <?php
                            foreach($nombres as $nombre){
                                echo "<li>$nombre</li>";
                            }
                        ?>
                    </ul>
                </td>
            </tr>
        </table>
        <br> <hr>
        <table width="100%">
            <tr>
                <th>2. REGISTRO DE PARTICIPANTES</th>
            </tr>
            <tr>
                <td style="font-weight: bold; border: 0px solid white;">a) Periodo de Evaluación:</td>
                <td style="border: 0px solid white;"> {{$periodo}}</td>
                <td style="font-weight: bold; border: 0px solid white;">d) Número de participantes que acreditaron:</td>
                <td style="border: 0px solid white;"> {{$acreditaron}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; border: 0px solid white;">b) Número de participantes inscritos:</td>
                <td style="border: 0px solid white;">{{$inscritos}}</td>
                <td style="font-weight: bold; border: 0px solid white;">d) Número de participantes que contestaron el formato de evaluación:</td>
                <td style="border: 0px solid white;">{{$contestaron}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; border: 0px solid white;">c) Número de participantes que asistieron</td>
                <td style="border: 0px solid white;">{{$asistencia}}</td>
            </tr>
        </table>
        <br> <hr>
        <table width="100%">
            <tr>
                <th>3. FACTOR DE OCUPACIÓN</th>
                <td style="border: 0px solid white;">{{$factor_ocupacion}}</td>
        </table>
        <br> <hr>
        <table width="100%">
            <tr>
                <th>5. FACTOR DE RECOMENDACION DE LOS CURSOS</th>
                <td style="border: 0px solid white;"> {{$factor_recomendacion}}</td>
            </tr>
        </table>
        <br> <hr>
        <table width="100%">
            <tr>
                <th>5. FACTOR DE ACREDITACIÓN</th>
                <td style="border: 0px solid white;"> {{$factor_acreditacion}}</td>
            </tr>
        </table>
        <br> <hr>
        <table width = "100%">
            <tr>
                <th>6. FACTOR DE CALIDAD</th>
                <td style="border: 0px solid white;"> {{$positivas}}</td>
            </tr>
        </table>
        <br> <hr>

       <table width="100%">
            <tr>
                <th>INSTRUCTORES QUE SE VOLVERÍAN A CONTRATAR</th>
            </tr>
            <tr>
                <td style="border: 0px solid white;">
                    <ul>
                        <?php
                        
                                foreach($profesors as $profesor){
                                    echo "<li>$profesor->nombres $profesor->apellido_paterno $profesor->apellido_materno</li>";
                                }
                        ?>
                    </ul>
                </td>
            </tr>
       </table>
        <br> <hr>
        <table width="100%">
            <tr>
                <th>8. ÁREAS SOLICITADAS</th>
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
                <th>9. TEMÁTICA SOLICITADAS</th>
            </tr>
            <tr>
                <th style="background-color: #2A4EDF; color: white;">DP</th>
                <th style="background-color: #2A4EDF; color: white;">DI</th>
                <th style="background-color: #2A4EDF; color: white;">DH</th>
                <th style="background-color: #2A4EDF; color: white;">CO</th>
                <th style="background-color: #2A4EDF; color: white;">Otros</th>
            </tr>
            <tr>
                <td style="border: 0px solid white;">
                    <ul>
                        <?php
                            foreach($DPtematicas as $tematica){
                                echo "<li>$tematica</li>";
                            }
                        ?>
                    </ul>
                </td>
                <td style="border: 0px solid white;">
                    <ul>
                        <?php
                            foreach($DItematicas as $tematica){
                                echo "<li>$tematica</li>";
                            }
                        ?>
                    </ul>
                </td>
                <td style="border: 0px solid white;">
                    <ul>
                        <?php
                            foreach($DHtematicas as $tematica){
                                echo "<li>$tematica</li>";
                            }
                        ?>
                    </ul>
                </td>
                <td style="border: 0px solid white;">
                    <ul>
                        <?php
                            foreach($COtematicas as $tematica){
                                echo "<li>$tematica</li>";
                            }
                        ?>
                    </ul>
                </td>
                <td style="border: 0px solid white;">
                    <ul>
                        <?php
                            foreach($Otrostematicas as $tematica){
                                echo "<li>$tematica</li>";
                            }
                        ?>
                    </ul>
                </td>
            </tr>
        </table>
        <br> <hr>
        <table width="100%">
            <tr>
                <th>10. HORARIOS SOLICITADOS</th>
            </tr>
            <?php

                foreach($horarios as $horario){
                    echo "<tr>";
                    echo "<td style=\"border: 0px solid white; padding-left:3em;\">$horario[0]</td>";
                    echo "<td style=\"border: 0px solid white; padding-left:3em;\">$horario[1]</td>";
                    echo "</tr>";
                }
                        
            ?>
        </table>
        <br> <hr>
        <div id = "Instructor">
            <table width="100%">
                <tr>
                    <th>11. CRITERIOS DE ACEPTACION</th>
                </tr>
                <tr>
                    <td style="border: 0px solid white;"> Contenido: {{$contenido}}</td>
                    <td style="border: 0px solid white;"> Instructores: {{$instructor}}</td>
                    <td style="border: 0px solid white;"> Coordinacion: {{$coordinacion}}</td>
                    <td style="border: 0px solid white;"> Recomendacion: {{$factor_recomendacion}}</td>
                </tr>
            </table>
        </div>
    </div>

    <button id="dia"  type="button" class="btn btn-primary active"><a href="{{route('area.pdf',[$periodo,$nombreCoordinacion])}}" style="color:white">Descargar PDF</a></button>
                         
                </div>
     </section>
@endsection