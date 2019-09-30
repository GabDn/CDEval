<?php


Route::get('/', function () {
    //return view('layouts.principal');
    return view('welcome');
});

Route::post('/autentificar', "AutentificarController@index")->name("autentificar");
