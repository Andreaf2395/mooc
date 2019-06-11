<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DB; 
use Carbon\Carbon;
use App\mcq_master;
use App\mcq_team_id;
use App\team_mcq_score;
use App\task;
use App\User;
use App\team_member_detail;
use App\task_schedule;
use App\team_course_map;

class McqController extends Controller
{
    //
    public function create($id)
    {
        
        $team_member_detail=team_member_detail::where('login_id',auth()->id())->first();
        
        $team_course_map=team_course_map::where('team_id',$team_member_detail->team_id)->firstorFail();

        
        $mcqs=mcq_master::where('task',$id)->where('c_id',$team_course_map->c_id)->firstorFail();//to ensure that a valid task is entered or else error 404

        $mcqs=mcq_master::where('task',$id)->where('c_id',$team_course_map->c_id)->get();//get all instances of mcq_master with task id as given in url and c_id

        //return $team_course_map;

        $task_schedule=task_schedule::where('task_id',$id)->where('c_id',$team_course_map->c_id)->firstorFail();//get the schedule with given task_id and course_id
        date_default_timezone_set('Asia/Kolkata');
        $current = Carbon::now();
        //return $current;
        $deadline= new Carbon($task_schedule->end_date);
        $time_up=$current->greaterThan($deadline);
        
        $mcq_options="";
        
        if(team_mcq_score::where('team_id',$team_member_detail->team_id)->where('task_id',$id)->first())
        {
        	$mcq_options=DB::table('mcq_team_ids')->join('mcq_masters',function($join)use($team_member_detail)
				{
					$join->on('mcq_team_ids.mcq_master_id','=','mcq_masters.id')
					->where('mcq_team_ids.team_id','=',$team_member_detail->team_id);
				})
					->select('mcq_masters.id','mcq_masters.question_id','mcq_team_ids.chosen_option')
					->get();
        	//return $mcq_options;
        }
        //return $mcq_options;
        //echo $id;
        //return $mcqs;
        return view('tasks.quiz',compact('mcqs','time_up','mcq_options'));
    }




        public function mcqstore($id,mcq_master $mcq_master,Request $request)
    {

    	
        try
        {
            
            DB::beginTransaction();
            $team_member_detail=team_member_detail::where('login_id',auth()->id())->first();
            $team_course_map=team_course_map::where('team_id',$team_member_detail->team_id)->firstorFail();

            //return $request->all();
        	$mcqs=mcq_master::where('task',$id)->where('c_id',$team_course_map->c_id)->firstorFail();
        	$mcqs=mcq_master::where('task',$id)->where('c_id',$team_course_map->c_id)->get();
        	$duration=300-request('time');
        	$count=0;
        	foreach($mcqs as $question)
        	{
        		if($question->correct_option==request($question->question_id))	
        			{
        				$count++;
        			}
        	}
        	//echo $count;	
        	//echo "<br>". $duration;

        	
        	//return $team_member_detail;


    	    if(team_mcq_score::where('team_id',$team_member_detail->team_id)->where('task_id',$id)->first())
    	    	echo "You can submit only once";
        	else
        	{	
        		
                
                foreach($mcqs as $question)
                {
                    $mcq_options=mcq_team_id::firstOrCreate(['team_id'=>$team_member_detail->team_id,'mcq_master_id'=>$question->id],['chosen_option'=>request($question->question_id)]);
                }


                $team_mcq_score=team_mcq_score::firstOrCreate(['team_id'=>$team_member_detail->team_id,'task_id'=>$id],['mcq_score'=>$count,'mcq_duration'=>$duration]);


    	    	
    	    	$task_status=task::where('team_id',$team_member_detail->team_id)->where('task_id',$id)->first();
    		    
    		    if($task_status)
    		    {
    		    	$task_status->update(['status'=>3,'total_score'=>$task_status->total_score+$count]);
    		    }
    		    else
    		    {
    		    	task::create(['team_id'=>$team_member_detail->team_id,'task_id'=>$id,'status'=>1,'total_score'=>$count]);
    		    }

    		    echo "success";
    	    }

            DB::commit();
        }

        catch (\Exception $e) {
    
            throw $e;
        } 

        return redirect('/tasks/'.$id.'#mcq');
    }
}
