<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeamMcqScore extends Model
{
    protected $table='team_mcq_score';
    protected $fillable =['team_id','task_id','mcq_score','mcq_duration','start_time','end_time'];
}
