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

//Route::get('/task0', function(){
//	return view('tasks.task0');
//});
Route::get('/task1', function(){
	return view('tasks.task1');
});
Route::get('/task2', function(){
	return view('tasks.task2');
});
<<<<<<< HEAD

Route::get('/quiz',function(){
	return view('quiz');
});
=======
>>>>>>> 8f0e0c62e8835cf029378a1365d6a43d038093ad


Route::get('/tasks/task1',function(){
	return view('tasks.task1');
});
Route::get('/signout', 'AuthController@signout');

<<<<<<< HEAD
;

Route::get('/tasks/{task}/create', 'mcqcontroller@create');
Route::post('/tasks/{task}', 'mcqcontroller@store');
=======
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/tasks/{task}/create', 'mcqcontroller@create');
Route::post('/tasks/{task}', 'mcqcontroller@store');

>>>>>>> 8f0e0c62e8835cf029378a1365d6a43d038093ad
