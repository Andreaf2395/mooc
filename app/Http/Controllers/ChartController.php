<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\task;
use App\team_course_map;
use App\team_member_detail;
use App\mcq_master;
use App\Model\TeamMcqDetails;

class ChartController extends Controller
{
    public function showchart($id)
    {

    	$score_counts=array();
    	$count=0;
    	//Populating score_counts array that counts the number of teams in each range (['0-2', '3-4','5-6','7-8','9-10']) of marks
    	$score_counts[$count]=task::where(['task_id'=>$id])->whereBetween('total_score',[0,2])->count();
    	for($b=4;$b<=10;$b+=2)
    	{
    		$score_counts[++$count]=task::where(['task_id'=>$id])->whereBetween('total_score',[$b-1,$b])->count();
    	}
    	//Print_r($score_counts);

    	$team_member_detail=team_member_detail::where('login_id',auth()->user()->id)->first();
        $team_course_map=team_course_map::where('team_id',$team_member_detail->team_id)->firstorFail();//get the user's team_course_map instance 
        $total_teams=team_course_map::where('c_id',$team_course_map->c_id)->count(); //find total number of teams registered for a course
        $unattempted=array();
        $attempted_and_wrong=array();
        $attempted_and_right=array();
        $mcqs=mcq_master::where(['task'=>$id,'c_id'=>$team_course_map->c_id])->get();
        foreach($mcqs as $mcq){
        	$no_unattempted=TeamMcqDetails::where('mcq_master_id',$mcq->id)->whereNull('chosen_option')->count();
        	$no_correct=TeamMcqDetails::where(['mcq_master_id'=>$mcq->id,'chosen_option'=>$mcq->correct_option])->count();
        	array_push($unattempted,$no_unattempted);
        	array_push($attempted_and_right,$no_correct);
        	array_push($attempted_and_wrong,$total_teams-$no_unattempted-$no_correct);
        }


    	return view('tasks.chart',compact('score_counts','unattempted','attempted_and_wrong','attempted_and_right'));
    }
}
