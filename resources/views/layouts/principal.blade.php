<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/img/cdd.ico') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>CDEval</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/jquery.fancybox.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/principal.css') }}">
</head>
<body>
<div class="wrap">
<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="Login.aspx" style="vertical-align: middle">
                    <img class="img-cdd" src="/img/cdd.png" style="vertical-align: middle" /></a>
                <label class="navbar-text text-center text-primary" style="vertical-align:10px;font-size:medium">Evaluaciones Centro de Docencia</label>
            </div>
        </div>
    </nav>
    <div class="container-sidebar">
        <div id="sidebar">
            <ul>
                <li><a href="#">Información Personal</a></li>
                <li><a href="#">Cursos Impartidos</a></li>
                <li><a href="#">Cursos Inscritos</a></li>
                <li><a href="#">Sign Out</a></li>
            </ul>
        </div>
    </div>
<br>
    <footer class="content-inner">
        <div class="panel panel-default">
            <div class="panel-heading">
                Hecho en México, Universidad Nacional Autónoma de México, Facultad de Ingeniería, Unidad de servicios de cómputo académico, Departamento de Investigación y Desarrollo.
                Todos los derechos reservados 2019.
            </div>
        </div>
    </footer>
</div>

</body>
</html>