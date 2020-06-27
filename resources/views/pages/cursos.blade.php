@extends('layouts.app')

@section('contenido')

@if(!empty($message))
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
                                    <th>Instructor</th>
                                    <th>Semestre</th>
                                    <th>Evaluación</th>
                                </tr>
                            </thead>
                            @foreach($cursos as $curso)
                            <tbody>
                                <tr>
                                    <td>{{ $curso->id }}</td>
                                    <td>{{ $curso->getNombreCurso() }}</td>
                                    <td>{{ $curso->getProfesores2() }}</td>
                                    <td>{{ $curso->semestre_anio }}-{{ $curso->semestre_pi }}{{ $curso->semestre_si }}</td>
                                    <td>
                                    <a href="{{ route('ver.sesion.final',['curso_id'=>$curso->id,'pdf'=>0]) }}" class="btn btn-warning">Sesión</a>
                                    <a href="{{ route('ver.global.final',['curso_id'=>$curso->id,'pdf'=>0]) }}" class="btn btn-success">Final</a>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>   
                </div>
     </section>
@endsection