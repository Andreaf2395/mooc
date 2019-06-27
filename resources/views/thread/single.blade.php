@extends('layouts.front')


@section('content')


<div class="thread-box">
    <div class="thread-content">
        <div>
            <span>
                @foreach($thread->tags as $tag)
                    <span class="badge green white-text" >{{$tag['name']}}</span>
                @endforeach
            </span>
            <h4 class="teal-text">{{$thread->subject}}</h4>
            <hr>

            <div class="thread-details" >
                {!!\Michelf\Markdown::defaultTransform($thread->thread)!!}
            </div>
            
            @if(auth()->user()->id == $thread->login_id)
                
                    <a href="{{route('thread.edit',$thread->id)}}" class="btn-floating btn-small waves-effect waves-light blue" class="action-element"><i class="material-icons small">edit</i></a>

                    {{--//delete form--}}
                    <form action="{{route('thread.destroy',$thread->id)}}" method="POST" class="action-element" >
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn-floating btn-small waves-effect waves-light red" type="submit" value="Delete"><i class="material-icons small">delete</i></button>
                    </form>
                
            @endif
            
                
               <span style="float:right;" class="author">Posted by {{$thread->login->username}} {{$thread->created_at->diffForHumans()}}</span>
                       
        </div>

    </div>

    

    @foreach($thread->comments as $comment)    

        <div >        

            @include('thread.partials.comment-list')
        
        </div>

        <br>
        <div class="col m10 offset-m2">
            @foreach($comment->comments as $reply)
            
            <div class="small well reply-list">
                <span class="reply-blockquote">{{$reply->body}}</span>
                <span class="author">--{{$reply->user->username}}</span> 

                
                <div >
                    @if(auth()->user()->id == $reply->user_id)
                    <a class="btn-floating btn-small waves-effect waves-light blue modal-trigger" href="#reply{{$reply->id}}"><i class="material-icons small">edit</i></a>
                   
                    <div class="modal" id="reply{{$reply->id}}">
                        <div class="modal-content">
                            <h4>Edit reply</h4>
                                <form action="{{route('comment.update',$reply->id)}}" method="post" >
                                    {{csrf_field()}}
                                    {{method_field('put')}}
                                    <div class="input-field">
                                        <textarea type="text" class="materialize-textarea" name="body" id="" >{{$reply->body}}</textarea>        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-small">Save</button>
                                    </div>
                            </form>                            
                        </div><!-- /.modal-content -->  
                    </div><!-- /.modal -->


                    {{--//delete form--}}
                    <form action="{{route('comment.destroy',$reply->id)}}" method="POST" class="action-element">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn-floating btn-small waves-effect waves-light red" type="submit" value="Delete"><i class="material-icons small">delete</i></button>
                    </form>
                </div>
                @endif
            </div>
            <br><br>
        @endforeach

        </div>
    <br> <br><br> 

    @endforeach

</div>
    <br>

    <div class="comment-form">
        <form action="{{route('threadcomment.store',$thread->id)}}" method="post" role="form">
            {{csrf_field()}}
            <legend>Create comment</legend>

            <div class="form-group">
                <input type="text" class="form-control" name="body" id="" placeholder="Input...">
            </div>


            <button type="submit" class="btn btn-primary">Comment</button>
        </form>
    </div>


@endsection


@section('js')

    <script>
        function toggleReply(commentId){
            $('#reply-form-'+commentId).toggleClass('hidden');
        }
    </script>

@endsection



