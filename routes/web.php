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


/****************Auth routes ****************/
Auth::routes();

Route::get('/',function () {
		if(Auth::check())
        	return redirect()->route('home');
        return redirect()->route('login');
	});


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/signout', 'AuthController@signout');






/****************routes accessible to students ****************/


Route::get('/courses', function(){
	return view('courses');
});



Route::get('/tasks/{task}','CourseController@getTask')->name('taskpage');



Route::get('/tasks/{task}/mcq', 'McqController@getMcqDetails');
Route::post('/tasks/{task}/savemcq', 'McqController@mcqstore');
Route::get('/tasks/{task}/emittrats','McqController@recordtime');

Route::post('/tasks/{task}/assign', 'AssignmentController@assignstore');




