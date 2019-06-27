<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded=[];
    
    //defining many to many relationship between tags and threads
    public function threads()
    {
        return $this->belongsToMany(thread::class);
    }

}
