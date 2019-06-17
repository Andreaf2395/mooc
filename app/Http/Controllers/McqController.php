<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DB; 
use Carbon\Carbon;
use App\mcq_master;
use App\mcq_team_id;
use App\Model\TeamMcqScore;
use App\Model\TeamMcqDetails;
use App\task;
use App\User;
use App\team_member_detail;
use App\task_schedule;
use App\team_course_map;
use Log;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class McqController extends Controller
{





    //to get the mcq questions and the saved options if attempted
    public function getMcqDetails($id)
    {
        $mcq_options="";
        $disable_btn=false;
        $duration=300;
        $team_member_detail=team_member_detail::where('login_id',auth()->user()->id)->first();
        $team_id=team_member_detail::where('login_id',auth()->user()->id)->value('team_id');

        //check whether the user is the leader
        if($team_member_detail->role == 2){
            $disable_btn = true;
        }
        

        try{
            $team_course_map=team_course_map::where('team_id',$team_id)->firstorFail();//to check if team is assigned a course
            $mcqs=mcq_master::where('task',$id)->where('c_id',$team_course_map->c_id)->firstorFail();//to ensure that a valid task is entered
            $task_schedule=task_schedule::where(['task_id'=>$id,'c_id'=>$team_course_map->c_id])->firstorFail();//get the schedule with given task_id and course_id
        }
        catch(ModelNotFoundException $exception) {
            Log::info($exception->getMessage().'row not existing for team '.$team_id);
            return redirect()->route('taskpage',[$id])->withError('Course or task not assigned');
        }

        $current = Carbon::now();
        $deadline= new Carbon($task_schedule->end_date);
        $disable_btn=$current->greaterThan($deadline);// this flag checks if the submit button should be enabled or not.


        //get all instances of mcq_master with task id as given in url and c_id
        $mcqs=mcq_master::where(['task'=>$id,'c_id'=>$team_course_map->c_id])->get();

        
        //if mcqs are attempted get their saved options
        if($team_mcq_score=TeamMcqScore::where(['team_id'=>$team_id,'task_id'=>$id])->first())
        {
            $task_status=task::where(['team_id'=>$team_id,'task_id'=>$id])->value('status');
            if($task_status == null)
            {
                Log::info('start_time '.$team_mcq_score->start_time);
                $test_end_time=Carbon::createFromFormat('Y-m-d H:i:s', $team_mcq_score->start_time)->addMinutes(5);
                if($current->greaterThan($test_end_time) ){
                    $duration =400;
                    $disable_btn=true;
                }
                else{
                    $duration=$current->diffInSeconds($test_end_time);
                    
                }
            }
            elseif($task_status == 1 || $task_status == 3)
            {
                $duration =400;
                $disable_btn=true;
                $mcq_options=DB::table('team_mcq_dtls')->join('mcq_masters',function($join)use($team_member_detail)
                {
                    $join->on('team_mcq_dtls.mcq_master_id','=','mcq_masters.id')
                    ->where('team_mcq_dtls.team_id','=',$team_member_detail->team_id);
                })
                    ->select('mcq_masters.id','mcq_masters.question_id','team_mcq_dtls.chosen_option')
                    ->get();
               
            }
        }
        return view('tasks.quiz',compact('mcqs','disable_btn','duration','mcq_options'));
    }









    //to save the mcq options 
    public function mcqstore($id,Request $request)
    {	
        $current = Carbon::now();
        try
        {
            DB::beginTransaction();
            $team_member_detail=team_member_detail::where('login_id',auth()->user()->id)->first();
            $team_course_map=team_course_map::where('team_id',$team_member_detail->team_id)->firstorFail();

            //check if mcqs are already submitted
            $task_status=task::firstorCreate(['team_id'=>$team_member_detail->team_id,'task_id'=>$id]);
    	    if($task_status->status == 1 || $task_status->status == 3)
    	    	return redirect()->route('taskpage',[$id])->withError('You can submit MCQs only once');
        	else
        	{	
                //Mcqs are submitted for the first time
                $mcqs=mcq_master::where(['task'=>$id,'c_id'=>$team_course_map->c_id])->get();
                
                
                $score=0;
                //score the mcq and save it
                foreach($mcqs as $mcq)
                {
                    if($mcq->correct_option==request('ques'.$mcq->question_id))  
                        $score++;       
                    TeamMcqDetails::create([
                        'team_id'=>$team_member_detail->team_id,
                        'mcq_master_id'=>$mcq->id,
                        'chosen_option'=>request('ques'.$mcq->question_id)
                    ]);   
                }
                //save the score and duartion
                $team_mcq_score=TeamMcqScore::where(['team_id'=>$team_member_detail->team_id,'task_id'=>$id])->first();
                $test_start_time=Carbon::createFromFormat('Y-m-d H:i:s', $team_mcq_score->start_time);
                $duration_server=$test_start_time->diffInSeconds($current);
                $team_mcq_score->mcq_duration=$duration_server;
                $team_mcq_score->end_time=$current;
                $team_mcq_score->mcq_score=$score;
                $team_mcq_score->save();

                $durationfromclient=300-request('time');
                /*if($durationfromclient< $duration_server){
                    Log::info('client'.$durationfromclient);
                    Log::debug('server'.$duration_server);
                    Log::info('Something FISHY --- team '.$team_member_detail->team_id);
                }*/



                //updating the status of the task for the team
    	    	$task_status=task::firstorCreate(['team_id'=>$team_member_detail->team_id,'task_id'=>$id]);
    		    if($task_status->status==2)//task assignement is submitted before mcq
    		    	$task_status->update(['status'=>3,'total_score'=>$task_status->total_score+$score]);
    		    else
    		    	$task_status->update(['status'=>1,'total_score'=>$task_status->total_score+$score]);
    	    }

            DB::commit();
        }
        catch (Exception $e) {
            Log::info($e);
            return redirect()->route('taskpage',[$id])->withError('The mcqs could not be saved!');
        } 

        return redirect('/tasks/'.$id.'#mcq');
    }







    public function recordtime($id){
        $team_member_detail=team_member_detail::where('login_id',auth()->user()->id)->first();
        $team_id=team_member_detail::where('login_id',auth()->user()->id)->value('team_id');
        log::info('inside recordtime');
        if(TeamMcqScore::where(['team_id'=>$team_id,'task_id'=>$id])->first())
        {
            Log::info('have to check if the time limit has exceeded!!!!');
        }
        else{
            TeamMcqScore::create(['team_id'=>$team_member_detail->team_id,'task_id'=>$id,'mcq_score'=>0,'start_time'=>Carbon::now()]);
        }
    }


}
