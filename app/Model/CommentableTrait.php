<?php


namespace App\Model;
use App\Model\comment;
use App\Model\thread;

trait CommentableTrait
{
    //polymorphic relationship to show thread has many comments and comments have many replies
    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable')->latest();
    }
    
    //function to create a comment in comments table
    public function addComment($body)
    {
        $comment=new Comment();
        $comment->body=$body;
        $comment->user_id=auth()->user()->id;
        $this->comments()->save($comment);
        return $comment;
    }
}

