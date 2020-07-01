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
    .blank_row
    {
        height: 10px !important; /* overwrites any other rules */
        background-color: #FFFFFF;
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
    <section>
                <div class="panel-heading">
                    <h2><span class="fa fa-check-square-o"></span>    Evaluación por sesión de seminario </h3>
                </div>

                <div class="panel-body">
                    <div class="form-group row">
                        <div class="col-sm-10">
                        <h4> Curso:  {{ $catalogoCurso->nombre_curso }}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-sm-10">
                                <h4>Facilitador: {{ $curso->getProfesores() }}</h4>
                            </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <h4>Fecha: {{ $curso->getToday() }}</h4>
                        </div>
                    </div>

                    <table class="table table-hover">
                    <tr>
                        <th width="100%" class='f' colspan="3">ASPECTOS A EVALUAR. MARQUE LA OPCIÓN QUE REPRESENTE A SU PARECER, EL DESARROLLO DEL TRABAJO EN LA SESIÓN</th>
                    </tr>
                    <tr>
                        <th align="float-right" class="f">PROFESOR</th>
                        <th align="float-right" class="f">RESPUESTA</th>
                        <th align="float-right" class="f">ARGUMENTO</th>
                    </tr>
                    <tr>
                        <th align="justify" colspan="3">1. Se presentó una orden del día </th>
                    </tr>
                        @foreach($evaluaciones as $evals)
                            <tr>
                                <td style="text-align:left;">{{$evals[0]->nombres}} {{$evals[0]->apellido_paterno}} {{$evals[0]->apellido_materno}}</td>
                                <td style="text-align:center;">
                                    <?php 
                                        if($evals[1]->p1 == 1){
                                            echo "Si";
                                        }
                                        else{
                                            echo "No";
                                        }
                                    ?></td>
                                <td style="text-align:left;">{{$evals[1]->p1_arg}}</td>
                            </tr>
                        @endforeach
                    <tr class="blank_row">
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <th align="justify" colspan="3">2. El o los objetivos del seminario son los esperados por el grupo </th>
                    </tr>
                        @foreach($evaluaciones as $evals)
                            <tr>
                                <td style="text-align:left;">{{$evals[0]->nombres}} {{$evals[0]->apellido_paterno}} {{$evals[0]->apellido_materno}}</td>
                                <td style="text-align:center;">
                                <?php 
                                        if($evals[1]->p2 == 1){
                                            echo "Si";
                                        }
                                        else{
                                            echo "No";
                                        }
                                    ?></td>
                                <td style="text-align:left;">{{$evals[1]->p2_arg}}</td>
                            </tr>
                        @endforeach
                    <tr class="blank_row">
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <th align="justify" colspan="3">3. El moderador centró el desarrollo de la sesión </th>
                    </tr>
                        @foreach($evaluaciones as $evals)
                            <tr>
                                <td style="text-align:left;">{{$evals[0]->nombres}} {{$evals[0]->apellido_paterno}} {{$evals[0]->apellido_materno}}</td>
                                <td style="text-align:center;">
                                <?php 
                                        if($evals[1]->p3 == 1){
                                            echo "Si";
                                        }
                                        else{
                                            echo "No";
                                        }
                                    ?></td>
                                <td style="text-align:left;">{{$evals[1]->p3_arg}}</td>
                            </tr>
                        @endforeach
                    <tr class="blank_row">
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <th align="justify" colspan="3">4. Se propició la participación de todos los asistentes </th>
                    </tr>
                        @foreach($evaluaciones as $evals)
                            <tr>
                                <td style="text-align:left;">{{$evals[0]->nombres}} {{$evals[0]->apellido_paterno}} {{$evals[0]->apellido_materno}}</td>
                                <td style="text-align:center;">
                                <?php 
                                        if($evals[1]->p4 == 1){
                                            echo "Si";
                                        }
                                        else{
                                            echo "No";
                                        }
                                    ?></td>
                                <td style="text-align:left;">{{$evals[1]->p4_arg}}</td>
                            </tr>
                        @endforeach
                    <tr class="blank_row">
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <th align="justify" colspan="3">5. Se levantó una minuta de sesión </th>
                    </tr>
                        @foreach($evaluaciones as $evals)
                            <tr>
                                <td style="text-align:left;">{{$evals[0]->nombres}} {{$evals[0]->apellido_paterno}} {{$evals[0]->apellido_materno}}</td>
                                <td style="text-align:center;">
                                <?php 
                                        if($evals[1]->p5 == 1){
                                            echo "Si";
                                        }
                                        else{
                                            echo "No";
                                        }
                                    ?></td>
                                <td style="text-align:left;">{{$evals[1]->p5_arg}}</td>
                            </tr>
                        @endforeach
                    <tr class="blank_row">
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <th align="justify" colspan="3">6. Se obtuvieron conclusiones </th>
                    </tr>
                        @foreach($evaluaciones as $evals)
                            <tr>
                                <td style="text-align:left;">{{$evals[0]->nombres}} {{$evals[0]->apellido_paterno}} {{$evals[0]->apellido_materno}}</td>
                                <td style="text-align:center;">
                                <?php 
                                        if($evals[1]->p6 == 1){
                                            echo "Si";
                                        }
                                        else{
                                            echo "No";
                                        }
                                    ?></td>
                                <td style="text-align:left;">{{$evals[1]->p2_arg}}</td>
                            </tr>
                        @endforeach
                    
                    </table>
               
    </div>
    </section>
    <br>
</html>