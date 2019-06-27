<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Model\TeamMcqScore;
use App\task;
use App\User;
use App\team_member_detail;
use App\task_schedule;
use App\team_course_map;
use App\Model\SubmissionType;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Log;

class CourseController extends Controller
{
    
    public function getTask($id){

		$team_id=team_member_detail::where('login_id',auth()->user()->id)->value('team_id');

		//to check if team id exists
		try{
			$team_course_map=team_course_map::where('team_id',$team_id)->firstorFail();
		}
		catch(ModelNotFoundException $exception){
			Log::info($exception->getMessage().'row not existing for team '.$team_id);
			return redirect('courses')->withError('Course not assigned');
		}
		
		$task_schedule=task_schedule::where('task_id',$id)->where('c_id',$team_course_map->c_id)->firstorFail();//to ensure that a valid task is entered or else error 404

		//date_default_timezone_set('Asia/Kolkata');
	    $current = Carbon::now();
		$deadline= new Carbon($task_schedule->end_date);
		//flag to check if deadline is over
	    $time_up=$current->greaterThan($deadline);

		$task=task::firstornew(['team_id'=>$team_id,'task_id'=>$id]);

		//$flag = $task->status;
		
		$team_mcq_score=0;
		if(TeamMcqScore::where('team_id',$team_id)->where('task_id',$id)->first())
	        {
	        	$team_mcq_score=TeamMcqScore::where('team_id',$team_id)->where('task_id',$id)->first();
	        }
	    //return $team_mcq_score;
	    $submission_types=SubmissionType::all();
	    //return $submission_types;

		return view('tasks.task'.$id,compact('team_mcq_score','submission_types','task','time_up'));
	}
}
