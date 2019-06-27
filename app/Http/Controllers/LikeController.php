<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\comment;
use Illuminate\Support\Facades\Input;

class LikeController extends Controller
{
	
	//function to handle liking and unliking of comment
	public function toggleLike()
	{
		
		$commentId=Input::get('commentId');
		$comment=Comment::find($commentId);
		//$usersLike=$comment->likes()->where('user_id',auth()->user()->id)->where('likable_id',$commentId)->first();

		//if comment is not already liked,it can be liked by using the function likeIt() specified in LikableTrait and similarly unlikeIt()
		if(!$comment->isLiked()){
			$comment->likeIt();
			return response()->json(['status'=>'success','message'=>'liked']);
		}else{
			$comment->unlikeIt();
			return response()->json(['status'=>'success','message'=>'unliked']);
		}

	}

}
