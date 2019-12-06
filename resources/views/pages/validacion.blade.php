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
            <div style="float: left; width: 100%; font-size: 22px;">Nombre del curso</div>
            <div style="float: right; width: 15%">semestre</div>
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
                <td class="n">{nombre}</td>
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
                <td class="n">{place}</td>
                
            </tr>     
        </table>
        <br>
        <table width="100%">
            <tr>
                <th>2. REGISTRO DE PARTICIPANTES</th>
            </tr>
            <tr>
                <td style="font-weight: bold" class="n">a) Inscritos</td>
                <td class="n">1</td>
                <td style="font-weight: bold ; margin-left: 50px white;" class="n" >c) Acreditaron</td>
                <td class="n">1</td>
            </tr>
            <tr>
                <td style="font-weight: bold" class="n">b) Asistieron</td>
                <td class="n">1</td>
                <td style="font-weight: bold ; margin-left: 50px white;" class="n">d) Formato de evaluación</td>
                <td class="n">1</td>
            </tr>
        </table>
        <br>
        <table width="100%">
            <tr>
                <th>3. FACTOR DE OCUPACIÓN</th>
                <td class="n">100.00</td>
                <th>4. FACTOR DE RECOMENDACIÓN</th>
                <td class="n">100.00</td>
            </tr>
        </table>
        <br>
        <table width="100%">
            <tr>
                <th>5. FACTOR DE ACREDITACIÓN</th>
                <td class="n">100.00</td>
                <th>6. FACTOR DE CALIDAD</th>
                <td class="n">{num}</td>
            </tr>
        </table>
        <br>
        <table width="100%">
            <tr>
                <th>7. FACTOR DE DESEMPEÑO INSTRUCTORES</th>
                <td class="n">{num}</td>
                <th width="15%">8. JUICIO SUMARIO INSTRUCTOR a)</th>
                <td class="n">{/}</td>
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
                <td class="n">{promedio}</td>
                <td class="n">{min}</td>
                <td class="n">{max}</td>
            </tr>
        </table>

        <br>
        <table width="100%">
            <tr>
                <th>8. JUICIO SUMARIO  CURSO b)</th>
                <td class="n">{num}</td>
                <td class="n">{/}</td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <th>9. RECOMENDACIONES</th>
            </tr>
            <tr><td class="n">SUGERENCIAS Y RECOMENDACIONES</td></tr>
        </table>
        <br>
        <table width="100%">
            <tr>
                <th>10. ÁREAS SOLICITADAS</th>
                <th>DP: </th>
                <td class="n">0</td>
                <th>DH: </th>
                <td class="n">1</td>
                <th>CO: </th>
                <td class="n">0</td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <th>11. TEMÁTICA SOLICITADAS</th>
            </tr>
            <tr><td class="n">TEMÁTICA</td></tr>
        </table>
        <br>
        <table width="100%">
            <tr>
                <th>12. HORARIOS SOLICITADOS</th>
            </tr>
            <tr>
                <th class="f">Horario Semestral</th>
                <th class="f">Horario intersemestral</th>
            </tr>
            <tr>
                <td class="n">HORARIOS</td>
                <td class="n">HORARIOI</td>
            </tr>
        </table>
    </div>


</div>

</body>
</html>