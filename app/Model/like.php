<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    protected $guarded=[];
    
    //polymorphic relationship
    public function likable()
    {
        return $this->morphTo();
    }
    
    //like belongs to the user
    public function user()
    {
        return $this->belongsTo(Login::class);
    }
}
