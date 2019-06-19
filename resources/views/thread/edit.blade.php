@extends('layouts.front')

@section('heading',"edit thread")

@section('content')

	

	<div class="row">
        <div class="col-md-12">
            <form class="card-panel" action="{{route('thread.update',$thread->id)}}" method="post" 
                  id="create-thread-form">
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="input-field col s12">  
                    <input type="text" class="form-control" name="subject" id="" placeholder="Input..."
                           value="{{$thread->subject}}">
                    <label for="subject">Subject</label>       
                </div>

                <div class="input-field col s12">
                    <input type="text" class="form-control" name="type" id="" placeholder="Input..." value="{{$thread->type}}">
                    <label for="type">Type</label>
                </div>

                <div class="input-field col s12">
                    <textarea class="materialize-textarea" name="thread" id="" placeholder="Input...">{{$thread->thread}}</textarea>
                    <label for="thread">Thread</label>
                </div>
          
                <button type="submit" class="waves-effect waves-light btn">Submit</button>
            </form>
        </div>
    </div>

@endsection