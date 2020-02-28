<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Validacion</title>
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
  font-size: 15px;
}
.f{
    background-color: #2A4EDF;
    color: white; 
}
.n{
    border: 0px solid white;
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
  border-bottom: none;
  border-top: 1px solid #000;
  border-left: none;
  border-right: none;
  border-spacing: 0;
}
#encabezado{
	/*padding: 10px;*/
}
.small{
	width: 20%;
hr{
	width: 10px;
}
#data, td, th{
	border-bottom: 1px solid #CC;
	border-collapse: collapse;
}
</style>
<body><div style="height: 90%">
	<div height="10%">
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
                    Formato<br>
					<br>
					Cursos tomados en el semestre: {{$semestre}}
				</td>
				<td rowspan="2" width="20%" align="center" id="normal"><br>
					<img src="img/cdd.png" alt="" align="center" height="112">
				</td>
			</tr>
		</table>
        <!--<br>-->
    </div>
	<div>
		<br>
		<br>
		<table id="Data" width="100%" style="border: none;">	
			<thead align="center">
				<tr style="border: none;">
					<td style="border: none; font-weight: 550;">
						Coordinacion
					</td>
					<td style="border: none; font-weight: 550;">
						Nombre del curso
					</td>
					<td style="border: none; font-weight: 550;">
						Duración
					</td>
					<td style="border: none; font-weight: 550;">
						Clave
					</td>
					<td style="border: none; font-weight: 550;">
						Tipo de curso Diploma
					</td>
				</tr>
			</thead>
			<tbody align="center">
			@foreach($cursos as $cursos)
				<tr align="center">
					<td style="border: none; border-bottom: 1pt solid black;"></td>
					<td style="border: none; border-bottom: 1pt solid black;">{{ $cursos[0]->nombre_curso }}</td>
					<td style="border: none; border-bottom: 1pt solid black;">{{ $cursos[0]->duracion_curso }}</td>
					<td style="border: none; border-bottom: 1pt solid black;">{{ $cursos[0]->clave_curso }}</td>
					<td style="border: none; border-bottom: 1pt solid black;">{{ $cursos[0]->tipo }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>

</body>

</html>