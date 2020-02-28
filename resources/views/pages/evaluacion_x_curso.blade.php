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
            <tr>
                <th>1. DATOS GENERALES DEL CURSO</th>
            </tr>
            <tr>
                <td style="font-weight: bold" class="n">a) Instructor</td>
                <td class="n">{{ $profesor->nombres}} {{$profesor->apellido_paterno}} {{$profesor->apellido_materno}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold" class="n">b) Fecha de impartición</td>
                <td class="n">{fecha}</td>
                <td style="font-weight: bold ; margin-left: 50px white;" class="n" >e) Capacidad</td>
                <td class="n">{núm}</td>
            </tr>
            <tr>
                <td style="font-weight: bold" class="n">c) Horario</td>
                <td class="n">{hora}</td>
                <td style="font-weight: bold ; margin-left: 50px white;" class="n">f) Total de horas</td>
                <td class="n">{núm}</td>
            </tr>
            <tr>
                <td style="font-weight: bold" class="n">d) Lugar</td>
                <td class="n">{lugar}</td>
                
            </tr>     
        </table>
        <br>
        <table width="100%">
            <tr>
                <th>2. PLANTEAMIENTO DE OBJETIVOS</th>
				<td class="n">{{$evaluacion[0]->p1}}</td>
            </tr>
        </table>
        <br>
        <table width="100%">
            <tr>
                <th>3. MANEJO DEL TEMA</th>
                <td class="n">{{$evaluacion[0]->p2}}</td>
                <th>4. CLARIDAD EN LA EXPOSICION</th>
                <td class="n">{{$evaluacion[0]->p3}}</td>
            </tr>
        </table>
        <br>
        <table width="100%">
            <tr>
                <th>5. MANEJO DEL MATERIAL Y RECURSOS DIDÁCTICOS</th>
                <td class="n">{{$evaluacion[0]->p4}}</td>
                <th>6. PLANTEAMIENTO DE PROBLEMAS</th>
                <td class="n">{{$evaluacion[0]->p5}}</td>
            </tr>
        </table>
        <br>
        <table width="100%">
            <tr>
                <th>7. USO DE EJEMPLOS</th>
                <td class="n">{{$evaluacion[0]->p6}}</td>
                <th width="15%">8. FOMENTO DE PARTICIPACIÓN GRUPAL</th>
                <td class="n"><pre>  </pre>{{$evaluacion[0]->p7}}</td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <th>9. CONTENIDOS A ABORDAR EN PRACTICA DOCENTE</th>
				<td class="n">{{$evaluacion[0]->contenido}}</td>
            </tr>
            <tr>
                
            </tr>
        </table>
		<table width="100%">
            <tr>
                <th>10. COMENTARIOS Y SUGERENCIAS</th>
				<td class="n">{{$evaluacion[0]->sug}}</td>
            </tr>
            <tr>
                
            </tr>
        </table>
    </div>


</div>

</body>
</html>