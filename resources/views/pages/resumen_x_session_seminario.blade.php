<!-- Guardado en resources/views/pages/xsesion.blade.php -->
@extends('layouts.app')

@section('contenido')
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
  <div class="content">
    <div class="top-bar">       
      <a href="#menu" class="side-menu-link burger"> 
        <span class='burger_inside' id='bgrOne'></span>
        <span class='burger_inside' id='bgrTwo'></span>
        <span class='burger_inside' id='bgrThree'></span>
      </a>      
    </div>
    <section class="content-inner">
    
      <div class="panel panel-default">
      @if(session()->has('msj'))
        <div class="alert alert-success" role='alert'>{{session('msj')}}</div>
      @endif
                <div class="panel-heading">
                    <h2><span class="fa fa-check-square-o"></span>    Evaluación por sesión de seminario </h3>
                </div>

                <div class="panel-body">
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-10">
                        <h4> Curso:  {{ $catalogoCurso->nombre_curso }}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-sm-10">
                                <h4>Facilitador: {{ $curso->getProfesores() }}</h4>
                            </div> 
                    </div>
                    <br>
                    <table class="table table-hover">
                    <tr>
                        <th width="42%">ASPECTOS A EVALUAR.</th>
                    </tr>
                    <tr>
                        <th align="float-right" class="f">PROFESOR</th>
                        <th align="float-right" class="f">RESPUESTA</th>
                        <th align="float-right" class="f">ARGUMENTO</th>
                    </tr>
                    <tr>
                        <th align="justify">1. Se presentó una orden del día </th>
                    </tr>
                            @foreach($evaluaciones as $evals)
                                <tr>
                                <td>{{$evals[0]->nombres}} {{$evals[0]->apellido_paterno}} {{$evals[0]->apellido_materno}}</td>
                                <td>
                                <?php 
                                        if($evals[1]->p1 == 1){
                                            echo "Si";
                                        }
                                        else{
                                            echo "No";
                                        }
                                ?></td>
                                <td>{{$evals[1]->p1_arg}}</td>
                                </tr>
                            @endforeach
                    <tr>
                        <th align="justify">2. El o los objetivos del seminario son los esperados por el grupo </th>
                    </tr>
                        @foreach($evaluaciones as $evals)
                                <tr>
                                <td>{{$evals[0]->nombres}} {{$evals[0]->apellido_paterno}} {{$evals[0]->apellido_materno}}</td>
                                <td>
                                <?php 
                                        if($evals[1]->p2 == 1){
                                            echo "Si";
                                        }
                                        else{
                                            echo "No";
                                        }
                                ?></td>
                                <td>{{$evals[1]->p2_arg}}</td>
                                </tr>
                        @endforeach
                    <tr>
                        <th align="justify">3. El moderador centró el desarrollo de la sesión </th>
                    </tr>
                        @foreach($evaluaciones as $evals)
                                <tr>
                                <td>{{$evals[0]->nombres}} {{$evals[0]->apellido_paterno}} {{$evals[0]->apellido_materno}}</td>
                                <td>
                                <?php 
                                        if($evals[1]->p3 == 1){
                                            echo "Si";
                                        }
                                        else{
                                            echo "No";
                                        }
                                ?></td>
                                <td>{{$evals[1]->p3_arg}}</td>
                                </tr>
                        @endforeach
                    <tr>
                        <th align="justify">4. Se propició la participación de todos los asistentes </th>
                    </tr>
                        @foreach($evaluaciones as $evals)
                                <tr>
                                <td>{{$evals[0]->nombres}} {{$evals[0]->apellido_paterno}} {{$evals[0]->apellido_materno}}</td>
                                <td>
                                <?php 
                                        if($evals[1]->p4 == 1){
                                            echo "Si";
                                        }
                                        else{
                                            echo "No";
                                        }
                                ?></td>
                                <td>{{$evals[1]->p4_arg}}</td>
                                </tr>
                        @endforeach
                    <tr>
                        <th align="justify">5. Se levantó una minuta de sesión </th>
                    </tr>
                    @foreach($evaluaciones as $evals)
                                <tr>
                                <td>{{$evals[0]->nombres}} {{$evals[0]->apellido_paterno}} {{$evals[0]->apellido_materno}}</td>
                                <td>
                                <?php 
                                        if($evals[1]->p5 == 1){
                                            echo "Si";
                                        }
                                        else{
                                            echo "No";
                                        }
                                ?></td>
                                <td>{{$evals[1]->p5_arg}}</td>
                                </tr>
                        @endforeach
                    <tr>
                        <th align="justify">6. Se obtuvieron conclusiones </th>
                    </tr>
                    @foreach($evaluaciones as $evals)
                                <tr>
                                <td>{{$evals[0]->nombres}} {{$evals[0]->apellido_paterno}} {{$evals[0]->apellido_materno}}</td>
                                <td>
                                <?php 
                                        if($evals[1]->p6 == 1){
                                            echo "Si";
                                        }
                                        else{
                                            echo "No";
                                        }
                                ?></td>
                                <td>{{$evals[1]->p6_arg}}</td>
                                </tr>
                        @endforeach
                    
            </table>
    </div>
        <button type="submit" class="btn btn-primary active"><a href="{{route('ver.sesion.final',['curso_id'=>$curso_id,'pdf'=>1,'encargado_id'=>$encargado_id])}}" style="color:white">Descargar</a></button>
     </section>
    <br>
@endsection