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


Route::get('/',function () {
		if(Auth::check())
        	return redirect()->route('home');
        return redirect()->route('login');
	});


Route::get('/home', 'HomeController@index')->name('home');



Route::get('/homepage', function(){
	return view('content');
});


Route::get('/courses', function(){
	return view('courses');
});

Route::get('/task1', function(){
	return view('tasks.task1');
});
Route::get('/task2', function(){
	return view('tasks.task2');
});
Route::get('/task3', function(){
	return view('tasks.task3');
});


Route::get('/signout', 'AuthController@signout');
