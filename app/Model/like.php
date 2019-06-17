<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    protected $guarded=[];
    
    public function likable()
    {
        return $this->morphTo();
    }
    
    public function user()
    {
        return $this->belongsTo(Login::class);
    }
}
