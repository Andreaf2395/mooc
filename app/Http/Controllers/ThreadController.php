<?php

namespace App\Http\Controllers;

use App\Model\thread;
use App\Model\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ThreadController extends Controller
{
    
    function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
         $this->validate($request, [
            'subject' => 'required|min:5',
            'tags'    => 'required',
            'thread'  => 'required|min:10',
            'g-recaptcha-response' => 'required|captcha'
        ]);
        //store
        //return $request->all();
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
        //
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
        if(auth()->user()->id !== $thread->login_id){
            abort(401,"unauthorized");
        }
        $this->validate($request, [
            'subject' => 'required|min:5',
            'type'    => 'required',
            'thread'  => 'required|min:10'
        ]);
        $thread->update($request->all());
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
        if(auth()->user()->id !== $thread->login_id){
            abort(401,"unauthorized");
        }
        $thread->delete();
        return redirect()->route('thread.index')->withMessage("Thread Deleted!");
    }


    public function markAsSolution()
    {
        $solutionId = Input::get('solutionId');
        $threadId = Input::get('threadId');
        $thread = thread::find($threadId);
        $thread->solution = $solutionId;
        if ($thread->save()) {
            return back()->withMessage('Marked as solution');
        }
    }


    public function search(Request $request)
    {
        dd('hi');
        /*$query=request('query');
        $threads = thread::search($query)->get();
        return view('thread.index', compact('threads'));*/
    }
}
