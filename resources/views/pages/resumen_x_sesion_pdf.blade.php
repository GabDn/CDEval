<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Evaluación de área</title>
</head>
<style>
    html{
	    width:100%;
    }
    .margen{
        border: 1px solid #ddd;  
        font-family:Arial, Helvetica, Sans-serif,cursive;   
        font-size: 12px;    
    }
    .margen2{
        border: 1px solid black;        
    }
    #tabla_encabezado{
        border-collapse: collapse;
        border: 1px solid #ddd;
        height: 50px;
        width:100%;
    }
    #tabla_encabezado_debajo{
        border-collapse: collapse;
        border: 1px solid #ddd;
        height: 5%;
        width:100%;
        text-align:center;
        font-family:Arial, Helvetica, Sans-serif,cursive; 
        font-size: 9px;
    }
    #tabla_lista{
        border-collapse: collapse;
        border: 1px solid black;
        height: 5%;
        width:100%;
        text-align:left;
        font-family:Arial, Helvetica, Sans-serif,cursive; 
        font-size: 11px;
    }
    #encabezado{
        font-family:Arial, Helvetica, Sans-serif,cursive; 
        text-align: center;
        font-size: 12px;
        line-height:90%;
    }
    #imagen_izquierda{
        margin-left: 15%;
    }
    #imagen_derecha{
        margin-left: 14%;
    }
    .titulos{
        font-family:Arial, Helvetica, Sans-serif,cursive; 
        font-size: 13px;
        font-weight: bold;
        background-color: #B4B0B0;

    }
    .inicial{
        font-family:Arial, Helvetica, Sans-serif,cursive; 
        font-size: 13px;
        font-weight: bold;  
    }
    .valores{
        font-family:Arial, Helvetica, Sans-serif,cursive; 
        font-size: 11px;
    }
    .tipo{
        font-family:Arial, Helvetica, Sans-serif,cursive; 
        font-size: 14px;
        font-weight: bold;
    }
   .mayus{
        text-transform: uppercase;
    }
    .f{
       background-color: #2A4EDF;
        color: white; 
        width: 100%;
    }

</style>
<body>
	<div>
		<table  id="tabla_encabezado">
				<td width= 12% class="margen">
                    <img id="imagen_izquierda"  src="img/fi_2.png" height="80">
				</td>
				<td width= 58% id="encabezado" class="margen" style="line-height=20px">
			        FACULTAD DE INGENIERÍA, UNAM<br/>
			        Secretaria de Apoyo a la Docencia<br>
			        Centro de Docencia "Ing. Gilberto Borja Navarrete"<br/>
			        Sistema de Gestión de la Calidad<br/>
			        Norma ISO 9001-2015<br/>
			        Formato
				</td>
				<td width= 12% class="margen">
                    <img id="imagen_derecha" src="img/cdd.png" height="80">
				</td>
		</table>
        <table id="tabla_encabezado_debajo">
				<td width="20%" class="margen">
					2730-SGC-IC-FO-10
				</td>
				<td  class="margen">
					Fecha de emisión:
				</td>
				<td class="margen">
                    2017-03-30
				</td>
				<td class="margen">
					Versión
				</td>
				<td class="margen">
					1
				</td>
				<td width="20%" class="margen">
					Página 1 de 1
				</td>
		</table>
   
    <section class="content-inner">
    
      <div class="panel panel-default">
                <div class="panel-heading">
                    <h2><span class="fa fa-check-square-o"></span>    Evaluación por sesión de curso </h3>
                </div>

                <div class="panel-body">
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-10">
                        <h4> Curso:  {{ $curso->getNombreCurso() }}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-sm-10">
                                <h4>Instructor: {{ $curso->getProfesores() }}</h4>
                            </div> 
                    </div>
                    
                    <br>
                    <table class="table table-hover" width="100%">
                    <tr>
                        <th align="justify" class="f" colspan="2">La forma en la que se alcanzaron los objetivos planteados fue </th>
                    </tr>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                $nombre = $evals[0]->nombres.' '.$evals[0]->apellido_paterno.' '.$evals[0]->apellido_materno;
                                switch ($evals[1]->p1) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </table>
                    <br>
                    <table width="100%">
                    <tr>
                        <th align="justify" class="f" colspan="2">La manera en que el instructor dominó y manejó el tema fue</th>
                    </tr>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                $nombre = $evals[0]->nombres.' '.$evals[0]->apellido_paterno.' '.$evals[0]->apellido_materno;
                                switch ($evals[1]->p2) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </table>
                    <br>
                    <table width="100%">
                    <tr>
                        <th align="justify" class="f" colspan="2">La claridad en la exposición fue</th>
                    </tr>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                $nombre = $evals[0]->nombres.' '.$evals[0]->apellido_paterno.' '.$evals[0]->apellido_materno;
                                switch($evals[1]->p3){
                                    case 100:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>   
                    </table>
                    <br>
                    <table width="100%">    
                    <tr>
                        <th align="justify" class="f" colspan="2">La habilidad para el manejo de material y recursos didácticos fue</th>
                    </tr>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                $nombre = $evals[0]->nombres.' '.$evals[0]->apellido_paterno.' '.$evals[0]->apellido_materno;
                                switch ($evals[1]->p4) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </table>
                    <br>
                    <table width="100%">
                    <tr>
                        <th align="justify" class="f" colspan="2">La forma en que se plantearon los problemas o actividades fue</th>
                    </tr>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                $nombre = $evals[0]->nombres.' '.$evals[0]->apellido_paterno.' '.$evals[0]->apellido_materno;
                                switch ($evals[1]->p5) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </table>
                    <br>
                    <table width="100%">
                    <tr>
                        <th align="justify" class="f" colspan="2">Los ejemplos utilizados favorecieron la comprensión del tema de una manera</th>
                    </tr>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                $nombre = $evals[0]->nombres.' '.$evals[0]->apellido_paterno.' '.$evals[0]->apellido_materno;
                                switch ($evals[1]->p6) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </table>
                    <br>
                    <table width="100%">
                    <tr>
                        <th align="justify" class="f" colspan="2">La forma en que se fomentó la participación grupal fue</th>
                    </tr>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                $nombre = $evals[0]->nombres.' '.$evals[0]->apellido_paterno.' '.$evals[0]->apellido_materno;
                                switch ($evals[1]->p7) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </table>
                    <br>
                    <table class="table table-hover" width="100%">
                        <tr>
                            <th align="justify" class="f" colspan="2">De los contenidos abordados. ¿Cuáles considera que puede incorporar a su práctica docente?</th>
                        </tr>
                            @foreach($evaluaciones as $evals)
                                <tr>
                                <td style="text-align:left;">{{$evals[0]->nombres}} {{$evals[0]->apellido_paterno}} {{$evals[0]->apellido_materno}}</td>
                                <td style="text-align:left;">{{$evals[1]->contenido}}</td>
                                </tr>
                            @endforeach
                    </table>
                    <br>
                    <table  width="100%">
                        <tr>
                            <th align="justify" class="f" colspan="2">Comentarios y Sugerencias</th> 
                        </tr>
                            @foreach($evaluaciones as $evals)
                                <tr>
                                <td style="text-align:left;">{{$evals[0]->nombres}} {{$evals[0]->apellido_paterno}} {{$evals[0]->apellido_materno}}</td>
                                <td style="text-align:left;">{{$evals[1]->sug}}</td>
                                </tr>
                            @endforeach
                    </table>
                </div>
    
     </section>
     <br>
</html>