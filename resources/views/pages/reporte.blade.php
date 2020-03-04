<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte para instructores</title>
</head>
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
  font-size: 18px;
  
}
hr{
    border: 1px solid #000;
  	border-spacing: 0;
  }
#mayusculas{
	text-transform: uppercase;
}
#contenido{
    padding:15px 60px 15px;
 
   
}
#renglonDoble, #mayusculas{
	 border: 1px solid white;
}
#normal{
	
   border-spacing: 0;
}
.encabezado{
	font-size: 25px;
}
.small{
	font-size: 12px;
}
.tabla{
	font-size: 12px;
	text-align: center;
	padding: 0px 2px;
	color: #3C3ABD;
	height: 100px;
}
</style>
<body>
<div style="height: 90%">
	<div height="10%">
		<hr/ >
		<hr>
		<div align="center" class="encabezado">
			UNIVERSIDAD NACIONAL AUTÓNOMA DE MÉXICO
		</div>
		
		<table style="width: 100%" align="center" id="encabezado" height="5%">
			<tr id="normal">
			<td rowspan="2" width="20%" align="center" id="normal"><br>
					<img src="img/fi.jpg" alt="" align="center" height="112">
				</td>
				<td rowspan="2" align="center" id="normal">
                    FACULTAD DE INGENIERÍA,UNAM<br>
                    Secretaría de Apoyo a la Docencia<br>
			        CENTRO DE DOCENCIA "Ing. Gilberto Borja Navarrete"<br>
			        Sistema de Gestión de la Calidad<br>
                    Norma ISO 9001:2015<br>
                    Formato
				</td>
				<td rowspan="2" width="20%" align="center" id="normal"><br>
					<img src="img/cdd.png" alt="" align="center" height="112">
				</td> 
			</tr>
		</table>
		<hr>
		<p align="center"><b>Encuestas del curso</b></p>
		<p align="center"><b>{{$curso->nombre_curso}}</b>
		</p>
		<p class="small" align="center">{{$semestre->semestre_anio}}-{{$semestre->semestre_pi}}</p>
		<hr/ >
	</div>
	<div id="cuerpo">
		<table align="right" width="100%">
			<tr>
				<td class="tabla" width="60%"></td>
				<td class="tabla" width="5%">Experiencia</td>
				<td class="tabla" width="5%">Planeación <br>y Organización</td>
				<td class="tabla" width="5%">Puntualidad</td>
				<td class="tabla" width="5%">Materiales de<br> apoyo</td>
				<td class="tabla" width="5%">Resolución de<br> dudas</td>
				<td class="tabla" width="5%">Control de grupo</td>
				<td class="tabla" width="5%">Interés que despertó</td>
				<td class="tabla" width="5%">Actitud del instructor</td>
			</tr>			
		</table>
		<br>
		<br>


		

		<table id="contenido">
			<tr>
				<td>Objetivo:</td>
				<td>{{$curso->objetivo}}</td>
			</tr>
			<tr>
				<td>Contenido:</td>
			 	<td>-Bases de datos(filtros, filtros avanzados, ordenamisntos, subtotales)<br>
					-Tablas dinámicas<br>
					-Funciones y Fórmulas avanzadas (Sí, busca rv, funciones lógicas, matriciales)<br>
					-Consolidar<br>
					-Escenarios<br>
					-Introducción a Macros<br>
				</td>
			</tr>
			<tr>
				<td>Antecedentes:</td>
				<td>{{$curso->previo}}</td>
			</tr>
			<tr>
				<td>Duración</td>
				<td>{{$curso->duracion_curso}} h</td>
			</tr>
		</table>
	</div>
<a href="{{ url('/publicidad/pdf') }}" class="btn btn-info" style="text-align:right">PDF</a></td>
</body>
</html>