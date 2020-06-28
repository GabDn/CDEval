@extends('layouts.app')

@section('contenido')

@if($message!=0)
    <div class="alert alert-success" style = "text-align:center;"> {{ $message }}</div>
@endif

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
              <h3>Cursos</h3>
              {!! Form::open(["route" => "buscar.curso", "method" => "GET"]) !!}
              
              <div class="input-group">
                  {!!Form::text("pattern", null, [ "class" => "form-control", "placeholder" => "Buscar Curso"])!!}
                  <hr id="hr">
                  <br>
                  {!! Form::select('type', array(
                         'nombre' => 'Por nombre',
                         'instructor' => 'Por instructor'),
                         null,['class' => 'btn dropdown-toggle pull-left'] ) !!}
                
                  <span class="input-group-btn col-md-2">
                      <button class="btn btn-search " type="submit">Buscar</button>
                </span>
                   {!! Form::close() !!}
              </div>
          </div>

                <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Curso</th>
                                    <th>Instructor(es)</th>
                                    <th>Semestre</th>
                                    <th>Evaluación</th>
                                </tr>
                            </thead>
                            @foreach($cursos as $curso)
                            <tbody>
                                <tr>
                                    <td>{{ $curso[0]->id }}</td>
                                    <td>{{ $curso[1]->nombre_curso }}</td>
                                    <td>
                                    @foreach($curso[2] as $profesors)
                                        @foreach($profesors as $profesor)
                                         <p>{{ $profesor->nombres }} {{$profesor->apellido_paterno}} {{$profesor->apellido_materno}} </p>
                                        @endforeach
                                    @endforeach
                                    </td>
                                    <td>{{ $curso[0]->semestre_anio }}-{{ $curso[0]->semestre_pi }}{{ $curso[0]->semestre_si }}</td>
                                    <td>
                                    <a href="{{ route('ver.sesion.final',['curso_id'=>$curso[0]->id,'pdf'=>0,'encargado_id'=>$encargado_id]) }}" class="btn btn-warning">Sesión</a>
                                    <a href="{{ route('ver.global.final',['curso_id'=>$curso[0]->id,'pdf'=>0,'encargado_id'=>$encargado_id]) }}" class="btn btn-success">Final</a>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>   
                </div>
     </section>
@endsection