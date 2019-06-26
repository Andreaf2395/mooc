<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\team_member_detail;
use App\task;

class StatusController extends Controller
{
    
	public function showstatus()
	{
		$team_member_detail=team_member_detail::where('login_id',auth()->user()->id)->first();
		$team_id=team_member_detail::where('login_id',auth()->user()->id)->value('team_id');
		$task_statuses=array();
		$scores=array();
		//find task statuses of all the three tasks and corresponding scores and push into arrays $task_statuses and $scores
		for($id=1;$id<=3;$id++){
			$task_status=task::where(['team_id'=>$team_id,'task_id'=>$id])->value('status');
			$task_score=task::where(['team_id'=>$team_id,'task_id'=>$id])->value('total_score');
			array_push($task_statuses,$task_status);
			array_push($scores,$task_score);
		}
		//dd($task_statuses);
		

		return view('tasks.status',compact('task_statuses','scores'));
	}


}
