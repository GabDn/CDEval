<?php
Route::get('/', function () {

    //return view('layouts.principal');
    return view('welcome');
});

Route::post('/autentificar', "AutentificarController@index")->name("autentificar");


Route::get('evaluar/{profesor_id}/{curso_id}/{catalogoCurso_id}','EvaluacionController@index')->name('evaluacion.index');

