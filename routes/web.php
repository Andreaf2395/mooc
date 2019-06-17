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


//discussion forum routes
Route::resource('/thread','ThreadController');

Route::resource('comment','CommentController',['only'=>['destroy','update']]);

Route::post('comment/create/{thread}', 'CommentController@addThreadComment')->name('threadcomment.store');

Route::post('reply/create/{comment}', 'CommentController@addReplyComment')->name('replycomment.store');

Route::post('/thread/mark-as-solution','ThreadController@markAsSolution')->name('markAsSolution');

Route::post('comment/like','LikeController@toggleLike')->name('toggleLike');



