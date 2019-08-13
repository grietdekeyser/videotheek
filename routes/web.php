<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/copies/search', function () {
    return view('copies.search');
});
Route::post('/copies/search', 'CopyController@search');

Route::get('/movies/delete', 'MovieController@chooseToDelete');
Route::delete('/movies/delete', 'MovieController@delete');
Route::get('/copies/delete', 'CopyController@chooseToDelete');
Route::delete('/copies/delete', 'CopyController@delete');

Route::get('/copies/rent', 'CopyController@chooseToRent');
Route::patch('/copies/rent', 'CopyController@rent');
Route::get('/copies/return', 'CopyController@chooseToReturn');
Route::patch('/copies/return', 'CopyController@return');

Route::post('/copies/create', 'CopyController@create');

Route::resource('/movies', 'MovieController');
Route::resource('/copies', 'CopyController');





/* 
* validation messages nog aanpassen naar NL?
*/
