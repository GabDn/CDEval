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
<body>
<div style="height: 90%">
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
                    Formato
				</td>
				<td rowspan="2" width="20%" align="center" id="normal"><br>
					<img src="img/cdd.png" alt="" align="center" height="112">
				</td>
			</tr>
			
		</table>
        <br>
        <div align="center">
            <div style="float: left; width: 100%; font-size: 22px;">{{ $curso->nombre_curso  }}</div>
            <div style="float: right; width: 15%">{{ $semestre->semestre_anio }}</div>
            <div style="clear: both"></div>
            <hr>
        </div>
    </div>
    <div>
        <table width="100%">
			<thead>
				<tr>
					<td><pre>      </pre></td>
					<td>Experiencia</td>
					<td>Experiencia</td>
					<td>Planeacion y Organizacion</td>
					<td>Puntualidad</td>
					<td>Materiales de apoyo</td>
					<td>Resolución de dudas</td>
					<td>Control de grupo</td>
					<td>Interés que despertó</td>
					<td>Actitud del instructor</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{Nombre del instructor}</td>
				</tr>
				@foreach()
				<tr>
					<td>{calificacion}</td>
					<td>{calificacion}</td>
					<td>{calificacion}</td>
					<td>{calificacion}</td>
					<td>{calificacion}</td>
					<td>{calificacion}</td>
					<td>{calificacion}</td>
					<td>{calificacion}</td>
				</tr>
				@endforeach
			</tbody>
        </table>
    </div>


</div>

</body>
</html>