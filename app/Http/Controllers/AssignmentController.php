<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DB; 
use Carbon\Carbon;
use App\task;
use App\User;
use App\team_member_detail;
use App\task_schedule;
use App\team_course_map;
use App\assignment;
use App\submission_type;

class AssignmentController extends Controller
{
    //
    public function assignstore($id,Request $request)
    {
    	try
        {
        DB::beginTransaction();
        $type=request('submission_type');
        request()->validate([
            'submission_type'=>['required']
        ]);
    	//return $type;
        switch ($type) {
            case 1:
                request()->validate([
                    'assignment'=>['required','image','mimes:jpeg,png,jpg','max:2048']
                ]);
                $sub_type=1;
                //return $type;
                break;
            case 2:
                request()->validate([
                    'assignment'=>['required','mimes:mp4,mov,ogg','max:20000']
                ]);
                $sub_type=2;
                //return $type;
                break;
            case 3:
                request()->validate([
                    'assignment'=>['required','mimes:txt,pdf,doc,docx','max:10000']
                ]);
                $sub_type=3;
                //return $type;
                break;
            case 4:
                request()->validate([
                    'assignment'=>['required','mimes:zip','max:20000']
                ]);
                $sub_type=4;
                //return $type;
                break;
        }

        

        $team_member_detail=team_member_detail::where('login_id',auth()->id())->first();
        $team_course_map=team_course_map::where('team_id',$team_member_detail->team_id)->firstorFail();
        $task_schedule=task_schedule::where('task_id',$id)->where('c_id',$team_course_map->c_id)->firstorFail();
        
        //date_default_timezone_set('Asia/Kolkata');
        $current = Carbon::now();
        $deadline= new Carbon($task_schedule->end_date);
        $time_up=$current->greaterThan($deadline);
        $task_status=task::where('team_id',$team_member_detail->team_id)->where('task_id',$id)->first();

        if(!$time_up)
        { 

            if($task_status)
            {
                
                if($task_status->assign_id)
                {
                    //before deadline and an instance of task exists along with assign_id, so the user uploads are updated
                    //task status might be 2 or 3
                    $files = Storage::allFiles('public/task'.$id.'/team'.$team_member_detail->team_id);
                    Storage::delete($files);
                    //delete already existing files in the directory
                    $assignment=$this->assign($id,$sub_type,$request);
                    //update assignments table

                }
                else
                {
                    //before deadline and an instance of task exists without assign_id (status 1), so when the user uploads the assignment status becomes 3
                    $assignment=$this->assign($id,$sub_type,$request);
                    //create assignment instance with the details  
                    $task_status->update(['status'=>3,'total_score'=>$task_status->total_score+$assignment->assign_score,'assign_id'=>$assignment->id]);
                    //update task's status, score and assign_id
                }

                
            }
        else
            {
                //if task instance is not present
                $assignment=$this->assign($id,$sub_type,$request);
                //create assignment instance with the details 
                task::create(['team_id'=>$team_member_detail->team_id,'task_id'=>$id,'status'=>2,'total_score'=>$assignment->assign_score,'assign_id'=>$assignment->id]);
            }

        }

        DB::commit();
        }
        catch (\Exception $e) {
    
            throw $e;
        } 


    	return redirect('/tasks/'.$id.'#assign')->withMessage('Your response is recorded');
    }

    public function assign($id,$sub_type,Request $request)
    {
        
        $team_member_detail=team_member_detail::where('login_id',auth()->id())->first();
        $current = Carbon::now();
        $task_status=task::firstornew(['team_id'=>$team_member_detail->team_id,'task_id'=>$id]);

        if($request->hasFile('assignment'))
        {
            $file=$request->file('assignment');
            $filename=$file->getClientOriginalName();
            $file->storeAs('public/task'.$id.'/team'.$team_member_detail->team_id,$filename);
            $filepath=$file->getPathName();
            $fileext=$file->getClientOriginalExtension();
        }
        //get the file details
        if($task_status->assign_id)
        {
            $assignment=assignment::where('id',$task_status->assign_id)->first();
            $assignment->update([
            'folder_name'=>$filename,
            'folder_ext'=>$fileext,
            'folder_path'=>$filepath,
            'upload_date'=>$current,
            'upload_num'=>$assignment->upload_num+=1,
            'sub_type'=>$sub_type
            ]);            
        }
        else
        {
            $assignment=assignment::create([
            'folder_name'=>$filename,
            'folder_ext'=>$fileext,
            'folder_path'=>$filepath,
            'upload_date'=>$current,
            'upload_num'=>1,
            'sub_type'=>$sub_type
            ]);
        }

        return $assignment;

    } 
}
