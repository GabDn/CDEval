@extends($layout)

@section('contenido')


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
              <h3>{{ $catalogoCurso->nombre_curso }}</h3>
                @foreach($profesors as $profesor)
                 {{ $profesor->nombres }} {{$profesor->apellido_paterno}} {{$profesor->apellido_materno}}. 
                @endforeach
              <p>{{ $curso->semestre_anio }}-{{ $curso->semestre_pi }}{{ $curso->semestre_si }}</p>
          </div>

                <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Participante</th>
                                    <th>Evaluación sesión</th>
                                    <th>Evaluación curso</th>
                                </tr>
                            </thead>
                            @foreach($participantes as $participante)
                            <tbody>
                                <tr>
                                    <td>{{$participante->nombres}} {{$participante->apellido_paterno}} {{$participante->apellido_materno}}</td>
                                    <td>
                                      @if($clase_resp[$participante->id] == 1)
                                      <button id="dia"  type="button" class="btn btn-success" disabled> <a href="{{ route('evaluacion.porSesion',[ $participante->id,$curso->id,$catalogoCurso->id,$count] ) }}" style="color:white">Evaluación por sesión</a></button>
                                      @else
                                      <button id="dia"  type="button" class="btn btn-success active"> <a href="{{ route('evaluacion.porSesion',[ $participante->id,$curso->id,$catalogoCurso->id,$count] ) }}" style="color:white">Evaluación por sesión</a></button>
                                      @endif
                                    </td>
                                    <td>
                                      @if($final_resp[$participante->id] == 1)
                                      <button id="final" type="button" class="btn btn-primary" disabled> <a href="{{ route('evaluacion.porCurso',[ $participante->id,$curso->id,$catalogoCurso->id,$count] ) }}" style="color:white">Evaluación final</a></button>
                                      @else
                                      <button id="final" type="button" class="btn btn-primary active"> <a href="{{ route('evaluacion.porCurso',[ $participante->id,$curso->id,$catalogoCurso->id,$count] ) }}" style="color:white">Evaluación final</a></button>
                                      @endif
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>   
                </div>
     </section>
@endsection