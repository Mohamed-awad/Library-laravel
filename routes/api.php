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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', 'CategoryController@index');

Route::post('/categories', 'CategoryController@store');

//Route::get('/tasks/{task}', 'TaskController@show');

Route::put('/categories/{id}', 'CategoryController@update');

Route::delete('/categories/{id}', 'CategoryController@destroy');


Route::get('/books', 'BookController@index');

Route::post('/books', 'BookController@store');

Route::get('/books/{id}', 'BookController@show');

Route::delete('/books/{id}', 'BookController@destroy');

Route::put('/books/{id}', 'BookController@update');