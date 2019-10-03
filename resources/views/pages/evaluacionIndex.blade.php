
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


  <div class="content">
    <div class="top-bar">       
      <a href="#menu" class="side-menu-link burger"> 
        <span class='burger_inside' id='bgrOne'></span>
        <span class='burger_inside' id='bgrTwo'></span>
        <span class='burger_inside' id='bgrThree'></span>
      </a>      
    </div>
    <section class="content-inner">
    <br>
      <div class="panel panel-default">
                <div class="panel-heading">
                    <h3> Curso:  {{ $catalogoCurso->nombre_curso }}</h3>
                    <h4> Instructor:  </h4>
                </div>

                <button href="{{ route('evaluacion.porSesion',[ $profesor->id,$curso->id,$catalogoCurso->id] ) }}" type="button" class="btn btn-primary active"> Evaluación por día</button>
                <button href="{{ route('evaluacion.porCurso',[ $profesor->id,$curso->id,$catalogoCurso->id] ) }}" type="button" class="btn btn-primary active">Evaluación por curso</button>

                <div class="panel-body">

                
                
                </div>

     </section>
     

<script src="{{ asset ('/js/jquery.js') }}"></script>
<script src="{{ asset ('/js/admin.js') }}"></script>
<script src="{{ asset ('/dist/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
</body>
</html>