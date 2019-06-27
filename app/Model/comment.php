<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use CommentableTrait,LikableTrait;

    protected $fillable=['body','user_id'];
    
    public function commentable()
    {
    	return $this->morphTo();
    }

    //relationship to show comment belongs to a user
    public function user()
    {
    	return $this->belongsTo(Login::class);
    }

}
