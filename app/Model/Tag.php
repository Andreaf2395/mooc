<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded=[];
    
    public function threads()
    {
        return $this->belongsToMany(thread::class);
    }

}
