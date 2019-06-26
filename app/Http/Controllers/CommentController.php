<?php

namespace App\Http\Controllers;

use App\Model\comment;
use App\Model\thread;
use Illuminate\Http\Request;
use App\Notifications\RepliedToThread;
use Illuminate\Support\Facades\Input;

class CommentController extends Controller
{
    
    public function addThreadComment(Request $request, thread $thread)
    {
        $this->validate($request,[
            'body'=>'required'
        ]);
        //$comment=new Comment();
        //$comment->body=$request->body;
        //$comment->user_id=auth()->user()->id;

        //$thread->comments()->save($comment);

        $thread->addComment($request->body);

        $thread->login->notify(new RepliedToThread($thread));

        return back()->withMessage('comment created');
    }


    public function addReplyComment(Request $request, comment $comment)
    {
        $this->validate($request,[
            'body'=>'required'
        ]);
        //$reply=new Comment();
        //$reply->body=$request->body;
        //$reply->user_id=auth()->user()->id;

        //$comment->comments()->save($reply);

        $comment->addComment($request->body);

        return back()->withMessage('reply created');
    }


    public function update(Request $request, comment $comment)
    {
        if($comment->user_id !== auth()->user()->id)
            abort('401');
        $this->validate($request,[
            'body'=>'required'
        ]);
        $comment->update($request->all());
        return back()->withMessage('updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(comment $comment)
    {
        if($comment->user_id !== auth()->user()->id)
            abort('401');
        $comment->delete();
        return back()->withMessage('Deleted');
    }


    public function markAsSolution()
    {
        $solutionId = Input::get('solutionId');
        //$threadId = Input::get('threadId');
        $comment = comment::find($solutionId);
        $comment->solution = 1;
        if ($comment->save()) {
            return back()->withMessage('Marked as solution');
        }
    }

}
