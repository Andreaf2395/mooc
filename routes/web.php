<?php


use Carbon\Carbon;
use App\team_mcq_score;
use App\task;
use App\User;
use App\team_member_detail;
use App\task_schedule;
use App\team_course_map;
use App\submission_type;
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
});// to be deleted


Route::get('/courses', function(){
	return view('courses');
});


Route::get('/signout', 'AuthController@signout');


Route::get('/tasks/{task}',function($id){

	$team_member_detail=team_member_detail::where('login_id',auth()->id())->first();
	$team_course_map=team_course_map::where('team_id',$team_member_detail->team_id)->firstorFail();//to check if team id exists
	$task_schedule=task_schedule::where('task_id',$id)->where('c_id',$team_course_map->c_id)->firstorFail();//to ensure that a valid task is entered or else error 404

	//date_default_timezone_set('Asia/Kolkata');
    $current = Carbon::now();
	$deadline= new Carbon($task_schedule->end_date);
    $time_up=$current->greaterThan($deadline);

	$task=task::firstornew(['team_id'=>$team_member_detail->team_id,'task_id'=>$id]);

	//$flag = $task->status;
	
	$team_mcq_score=0;
	if(team_mcq_score::where('team_id',$team_member_detail->team_id)->where('task_id',$id)->first())
        {
        	$team_mcq_score=team_mcq_score::where('team_id',$team_member_detail->team_id)->where('task_id',$id)->first();
        }
    //return $team_mcq_score;
    $submission_types=submission_type::all();
    //return $submission_types;

	return view('tasks.task'.$id,compact('team_mcq_score','submission_types','task','time_up'));
});


Route::get('/tasks/{task}/mcq', 'McqController@create');
Route::post('/tasks/{task}', 'McqController@mcqstore');
Route::post('/tasks/{task}/assign', 'AssignmentController@assignstore');




