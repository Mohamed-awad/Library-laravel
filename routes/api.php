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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::get('/categories/{id}', 'CategoryController@show');
Route::post('/categories', 'CategoryController@store');
Route::put('/categories/{id}', 'CategoryController@update');
Route::delete('/categories/{id}', 'CategoryController@destroy');

Route::get('/profits', 'BookLeasedController@index');
Route::post('/booklease', 'BookLeasedController@store');

Route::get('/users', 'UserController@index');
Route::post('/users', 'UserController@store');
Route::get('/users/{id}', 'UserController@show');
Route::delete('/users/{id}', 'UserController@destroy');
Route::put('/users/{id}', 'UserController@update');

Route::get('/{user_id}/favourites', 'BookFavouriteController@index');
Route::post('/{user_id}/favourite/{book_id}', 'BookFavouriteController@store');
Route::delete('/{user_id}/favourite/{book_id}', 'BookFavouriteController@destroy');

Route::get('/comments/{book_id}', 'CommentController@index');
Route::post('/comments/{book_id}/{user_id}', 'CommentController@store');
Route::delete('/comments/{comment_id}', 'CommentController@destroy');


Route::get('/bookss', 'BookController@index');
Route::get('/bookss/{id}', 'BookController@show');
Route::post('/bookss', 'BookController@store');

//////////////passport
Route::post('/login', 'PassportController@login');
Route::post('/register', 'PassportController@register');

Route::middleware('auth:api')->group(function () {
    Route::get('/user', 'PassportController@details');
    Route::get('/categories', 'CategoryController@index');

    //Route::resource('products', 'ProductController');

});


/////////////end


