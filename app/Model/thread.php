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
            'comments.body'=>10,
            'threads.subject' => 10,
            'threads.thread' => 8,
        ],
        'joins' => [
            'comments' => ['comments.id','comments.commentable_id','comments.commentable_type','App\Model\thread'],
         ],
    ];

    public function login()
    {
    	return $this->belongsTo(Login::class);
    }

    public function comments()
    {
    	return $this->morphMany(comment::class,'commentable')->latest();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'tag_thread');
    }
}
