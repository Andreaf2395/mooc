<?php

namespace App\Http\Controllers;
use App\Mail\submissionMail;
use App\task_schedule;
use App\team_course_map;
use App\task;
use App\team_member_detail;
use Carbon\Carbon;
use DB; 
use Mail;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    
	public function sendMail()
    {
    	
    	$current = Carbon::today();
    	$two_days_later=$current->addDays(2);


    	//find all the team_ids that have submitted the particular task whose deadline is two days away
    	$teams_submitted=DB::table('team_course_maps')
    		->join('task_schedules','team_course_maps.c_id','=','task_schedules.c_id')
    		->where('task_schedules.end_date','=',$two_days_later)
    		->join('tasks',[['tasks.team_id','=','team_course_maps.team_id'],['tasks.task_id','=','task_schedules.task_id']])
    		->where('tasks.status','=',3)
    		->select('team_course_maps.team_id','task_schedules.c_id','task_schedules.task_id')
            ->get();
        //dd($teams_submitted);

        //finding the team_ids that haven't submitted their course's particular task
        $teams_not_submitted=team_course_map::whereNotIn('team_id',$teams_submitted->pluck('team_id'))->whereIn('c_id',$teams_submitted->pluck('c_id'))->pluck('team_id');
        //dd($teams_not_submitted);

        //content to be displayed in the email
    	$content = [
    		'title'=> 'Reminder to submit task', 
    		'body'=> 'This is to inform you that you only have 2 more days to submit your task(MCQ and/or assignment)',
    		'button' => 'Click here'
    		];

		foreach($teams_not_submitted as $team){
			
			//checking for the mail_flag and sending the mail accordingly team wise in a queue
			if(!team_course_map::where('team_id',$team)->value('mail_flag')){

				$receiversAddress=team_member_detail::where('team_id',$team)->pluck('email');
				echo $receiversAddress;
	    		Mail::to($receiversAddress)->queue(new submissionMail($content));
	    		team_course_map::where('team_id',$team)->update(['mail_flag'=>1]);
	    	}
		}


    	dd('mail sent successfully');
    }

}
