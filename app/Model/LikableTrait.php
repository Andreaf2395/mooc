<?php



namespace App\Model;
use App\Model\like;


trait LikableTrait
{
    
    //polymorphic relationship to show comment has many likes
    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }

    //create a like entry in likes table
    public function likeIt()
    {
        $like = new Like();
        $like->user_id = auth()->user()->id;
        $this->likes()->save($like);
        return $like;
    }

    //delete the like entry when user unselects his like
    public function unlikeIt()
    {
        $this->likes()->where('user_id',auth()->user()->id)->delete();
    }

    //return boolean if user has liked or not
    public function isLiked()
    {
        return !!$this->likes()->where('user_id',auth()->user()->id)->count();
    }

}