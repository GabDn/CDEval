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
        <nav class="nav-bar navbar-inverse" role="navigation">
            <div id="top-menu" class="container-fluid active">
                <a class="navbar-brand" href="#">Centro de Docencia - Evaluaciones</a>
                <ul class="nav navbar-nav">
                    <li class="dropdown movable">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="fa fa-2x fa-user-circle"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            
                            <li>
                            <a href="#">
                            Salir</a>
                            </li>


                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <aside id="side-menu" class="aside" role="navigation">
            <ul class="nav nav-list accordion">
                <li class="nav-header">
                    <div class="link"><i class="fa fa-lg fa-book"></i>Información Personal<i class="fa fa-chevron-down"></i></div>
                    <ul class="submenu">
                        <li><a href="#">Cursos programados</a></li>
                    </ul>
                </li>

                <li class="nav-header">
                    <div class="link"><i class="fa fa-users"></i>Cursos Impartidos<i class="fa fa-chevron-down"></i></div>
                    <ul class="submenu">
                        <li><a href="#">submenu</a></li>
                    </ul>
                </li>

                <li class="nav-header">
                    <div class="link"><i class="fa fa-users"></i>Cursos Inscritos<i class="fa fa-chevron-down"></i></div>
                    <ul class="submenu">
                        <li><a href="#">submenu</a></li>
                    </ul>
                </li>
            </ul>
        </aside>

        <footer class="content-inner">
        <div class="panel panel-default">
            <div class="panel-heading">
                Hecho en México, Universidad Nacional Autónoma de México, Facultad de Ingeniería, Unidad de servicios de cómputo académico, Departamento de Investigación y Desarrollo.
                Todos los derechos reservados 2019.
            </div>
        </div>
    </footer>
    </div>
<script src="{{ asset ('/js/jquery.js') }}"></script>
<script src="{{ asset ('/js/admin.js') }}"></script>
<script src="{{ asset ('/dist/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
</body>

</html>