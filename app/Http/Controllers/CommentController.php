<?php

namespace App\Http\Controllers;

use App\Model\comment;
use App\Model\thread;
use Illuminate\Http\Request;
use App\Notifications\RepliedToThread;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Log;

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


    //code for realtime notifications
    /*
    public function commentNotificationPush(){
        $response = new StreamedResponse();
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        log::info('calling comment');
        $notification=auth()->user()->unreadNotifications;
        $response->setCallback(
            function() use ($notification) {
                    if(count($notification) != 0){
                        echo "retry: 5000\n\n"; // no retry would default to 3 seconds.
                        // echo "data: Hello There\n\n";
                        echo "data:  " . $notification." \n\n ";
                        // ob_flush();
                        // flush();
                    }
                    else{

                        echo "retry: 5000\n\n";
                        echo "data: \n\n ";
                             
                    }
                    });
            
        $response->send();

    }
*/
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
}
