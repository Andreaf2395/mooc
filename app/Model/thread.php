<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Thread extends Model
{
    use CommentableTrait;
    
    protected $fillable=['subject','type','thread','login_id'];

    public function login()
    {
    	return $this->belongsTo(Login::class);
    }

    public function comments()
    {
    	return $this->morphMany(comment::class,'commentable')->latest();
    }
}
