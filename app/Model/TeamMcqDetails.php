<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeamMcqDetails extends Model
{
    protected $table='team_mcq_dtls';
    protected $fillable =['team_id','chosen_option','mcq_master_id'];
}
