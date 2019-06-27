<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;


class Thread extends Model
{
    use CommentableTrait;
    
    protected $fillable=['subject','thread','login_id'];

    protected $searchable = [
        'columns' => [
            'comments.body'=>5,
            'threads.subject' => 10,
            'threads.thread' => 8,
        ],
        'joins' => [
            'comments' => ['comments.id','comments.commentable_id','comments.commentable_type','App\Model\thread'],
         ],
    ];

    //eloquent relationship to show a thread belongs to a user
    public function login()
    {
    	return $this->belongsTo(Login::class);
    }

    //defining many to many relationship between tags and threads
    public function tags()
    {
        //tag_thread is the intermediate table 
        return $this->belongsToMany(Tag::class,'tag_thread');
    }
}
