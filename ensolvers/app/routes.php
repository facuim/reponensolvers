<?php
/*|--------------------------------------------------------------------------
  | Application Routes 
  |--------------------------------------------------------------------------
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.*/


Route::get('/', 'UserController@renderTasksList'); 

Route::any('/', 'UserController@renderTasksList');

Route::get('/index', 'UserController@renderTasksList'); 

Route::get('/login','UserController@renderLogin');

Route::get('/taskslist','UserController@renderTasksList');

Route::post('addNewTask','UserController@addNewTask');

Route::any('deleteTask','UserController@deleteTask');

Route::any('updateTask','UserController@updateTask');

Route::post('logMeIn','UserController@logMeIn');

Route::any('/logout','UserController@logOut');

//Redireccion a pagina de error 404
App::missing(function($exception){
    return Response::view('ErrorPages.error404',array(),404);
});