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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/Questionnaire', 'questionnaire@index');
Route::get('/Questionnaire/create', 'questionnaire@getcreateview');
Route::post('/Questionnaire/create', 'questionnaire@postquestionnaire');
Route::get('/addquestion/{id}', 'questionnaire@getquestion');
Route::post('/addquestion', 'questionnaire@postquestion');
Route::get('/edit/{id}','questionnaire@edit');
Route::post('/Questionnaire/update','questionnaire@update');


