<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::group(['middleware' => 'auth'], function() {

//});
Route::group(['middleware' => 'cors'], function() {
    Route::post('login', 'AutenticacionController@postLogin');
    Route::resource('publicaciones','PublicacionesController',['only'=>['index','store','show','destroy']]);
    Route::resource('megusta','MegustaController',['only'=>['store']]);
    Route::resource('retar','RetarController',['only'=>['store']]);
    Route::resource('juegos','JuegosController',['only'=>['index','show','store']]);




    //Route::resource('juegosAPI','APIJuegosController',['only'=>['show','index']]);
    Route::get('carusel', 'APIJuegosController@carusel');

});

