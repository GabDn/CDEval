@extends('layouts.app')

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
              <h3>Evaluación por Sesión</h3>
              
              
              <div class="input-group">
    
                  
              </div>
          </div>

                <div class="panel-body">
                <h4>Participante: Juan Ramirez Gonzales</h4><hr>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Pregunta</th>
                                    <th>Respuesta</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr>
                                    <td>La forma en la que se alcanzaron los objetivos planteados fue</td>
                                    <td>Muy Bien</td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>La manera en que el instructor dominó y manejó el tema fue</td>
                                    <td>Bien</td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>La claridad en la exposición fue</td>
                                    <td>Regular</td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>La habilidad para el manejo de material y recursos didácticos fue</td>
                                    <td>Mal</td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>La forma en que se plantearon los problemas o actividades fue</td>
                                    <td>Muy Mal</td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>Los ejemplos utilizados favorecieron la comprensión del tema de una manera</td>
                                    <td>Muy Bien</td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>La forma en que se fomentó la participación grupal fue</td>
                                    <td>Bien</td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>De los contenidos abordados. ¿Cuáles considera que puede incorporar a su práctica docente?</td>
                                    <td>El tema sobre la mejora continua</td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>Comentarios y Sugerencias</td>
                                    <td>El Curso debería durar más, me encantó.</td>
                                </tr>
                            </tbody>
                        
                        </table>   
                </div>
     </section>
@endsection