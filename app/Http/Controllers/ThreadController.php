<?php

namespace App\Http\Controllers;

use App\Model\thread;
use App\Model\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ThreadController extends Controller
{
    
    //authentication required for all the below functions 
    function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //show threads pertaining to the tag selected
    public function index(Request $request)
    {
        if($request->has('tags')){
            $tag=Tag::find($request->tags);
            $threads=$tag->threads;
        }
        else{
            $threads= thread::paginate(15);
        }
        return view('thread.index',compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('thread.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validations
        $this->validate($request, [
            'subject' => 'required|min:5',
            'tags'    => 'required',
            'thread'  => 'required|min:10',
            'g-recaptcha-response' => 'required|captcha'
        ]);
        
        //store
        //return $request->all();
        //create the user's thread and create entries in the intermediate table tag_thread that shows the many-to-many relationship between tags and threads
        $thread = auth()->user()->threads()->create($request->all());
        $thread->tags()->attach($request->tags);
        
        //redirect
        return back()->withMessage('Thread Created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(thread $thread)
    {
        //show the single thread and its comments and replies to comments
        return view('thread.single',compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(thread $thread)
    {
        return view('thread.edit',compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, thread $thread)
    {
        //check if the user is authorized to edit the thread
        if(auth()->user()->id !== $thread->login_id){
            abort(401,"unauthorized");
        }
        //validations
        $this->validate($request, [
            'subject' => 'required|min:5',
            'tags'    => 'required',
            'thread'  => 'required|min:10'
        ]);
        //delete the existing tags from tag_thread and update the threads table and attach new tags
        $thread->tags()->detach();
        $thread->update($request->all());
        $thread->tags()->attach($request->tags);
        return redirect()->route('thread.show', $thread->id)->withMessage('Thread Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(thread $thread)
    {
        //check if the user is authorized to delete the thread
        if(auth()->user()->id !== $thread->login_id){
            abort(401,"unauthorized");
        }
        $thread->delete();
        return redirect()->route('thread.index')->withMessage("Thread Deleted!");
    }


    public function searchthread(Request $request)
    {
        //dd(request());
        //search the threads based on the search entry given by the user
        $query=request('query');
        $threads = thread::search($query)->paginate(15);
        return view('thread.index', compact('threads'));
    }
}
