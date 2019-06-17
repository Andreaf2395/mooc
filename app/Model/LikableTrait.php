<?php



namespace App\Model;
use App\Model\like;


trait LikableTrait
{
    
    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }

    public function likeIt()
    {
        $like = new Like();
        $like->user_id = auth()->user()->id;
        $this->likes()->save($like);
        return $like;
    }

    public function unlikeIt()
    {
        $this->likes()->where('user_id',auth()->user()->id)->delete();
    }

    public function isLiked()
    {
        return !!$this->likes()->where('user_id',auth()->user()->id)->count();
    }

}