<!-- Guardado en resources/views/layouts/principal.blade.php -->

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
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/admin.css') }}"/>

</head>
<body>
<div class="wrap">
    <nav class="nav-bar navbar-inverse" role="navigation">
        <div id ="top-menu" class="container-fluid active">
            <a class="navbar-brand" href="{{ URL::to('admin/') }}">Centro de Docencia - Evaluaciones</a>
            <ul class="nav navbar-nav">

                <li class="dropdown movable">
                    <!--Boton de usuario esquina superior derecha-->
                    <a href="#"  class="dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <i id="usericon" class="fa fa-2x fa-user-circle"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">


                        
                    </ul>

            </ul>
            </li>
            </ul>
        </div>
    </nav>

    <aside id="side-menu" class="aside" role="navigation">
        <ul class="nav nav-list accordion">
            <li class="nav-header">
                <div class="link"><i class="fa fa-info"></i>Información Personal<i class="fa fa-chevron-down"></i></div>
                <ul class="submenu">
                    <li><a href="#">submenu</a></li>
              
                </ul>
            </li>

    

            <li class="nav-header">
                <div class="link"><i class="fa fa-pencil"></i>Cursos Inscritos<i class="fa fa-chevron-down"></i></div>
                <ul class="submenu">
                @foreach($infoCursos as $infoCurso)
                    <li><a href="{{ route('evaluacion.index',[ $profesor->id,$infoCurso[0]->id,$infoCurso[1]->id] ) }}">{{ $infoCurso[1]->nombre_curso }}</a></li>
                @endforeach
                </ul>
            </li>
            
        </ul>
    </aside>

    @yield('contenido')

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