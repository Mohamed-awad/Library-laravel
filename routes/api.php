<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization, Content-Type');

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


Route::get('/categories/{id}', 'CategoryController@show');

Route::post('/categories', 'CategoryController@store');

Route::put('/categories/{id}', 'CategoryController@update');

Route::delete('/categories/{id}', 'CategoryController@destroy');

###################################################

Route::get('/users', 'UserController@index');
Route::post('/users', 'UserController@store');
Route::get('/users/{id}', 'UserController@show');
Route::delete('/users/{id}', 'UserController@destroy');

Route::put('/users/{id}', 'UserController@update');

###################################################


Route::get('/favourites', 'BookFavouriteController@index');
Route::post('/users/{user_id}/favourite/{book_id}', 'BookFavouriteController@store');
Route::delete('/users/{user_id}/favourite/{book_id}', 'BookFavouriteController@destroy');

Route::get('/books', 'BookController@index');

Route::post('/books', 'BookController@store');

Route::get('/books/{id}', 'BookController@show');

Route::put('/books/{id}', 'BookController@update');

Route::delete('/books/{id}', 'BookController@destroy');

Route::post('/login', 'PassportController@login');

Route::post('/register', 'PassportController@register');

Route::middleware('auth:api')->group(function () {
    Route::get('/user', 'PassportController@details');

    //Route::resource('products', 'ProductController');

});


