@extends('layouts.front')


@section('content')

	
    <div class="card-panel blue-grey lighten-5">
        <h4>{{$thread->subject}}</h4>
        <hr>

        
        <div class="thread-details">
            {!!\Michelf\Markdown::defaultTransform($thread->thread)!!}
        </div>
        <h6>Posted by {{$thread->login->username}} {{$thread->created_at->diffForHumans()}}</h6>
        

        @if(auth()->user()->id == $thread->login_id)
            <div class="actions">
                <a href="{{route('thread.edit',$thread->id)}}" class="btn btn-info btn-xs">Edit</a>

                {{--//delete form--}}
                <form action="{{route('thread.destroy',$thread->id)}}" method="POST" class="inline-it">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <input class="btn btn-xs btn-danger" type="submit" value="Delete">
                </form>
            </div>
        @endif
        @foreach($thread->tags as $tag)
        <span class="badge green white-text">{{$tag['name']}}</span>
        @endforeach
    </div>

    <hr>

    @foreach($thread->comments as $comment)    
        <div class="comment-list well well-lg">        
            
            @include('thread.partials.comment-list')
        
        </div>
        <hr>
        <!--reply to comment-->
        <button class="btn btn-xs btn-primary" onclick="toggleReply('{{$comment->id}}')">reply</button>
        
        <div style="margin-left: 50px" class="reply-form-{{$comment->id}} hidden">
            
            <form action="{{route('replycomment.store',$comment->id)}}" method="post" role="form">
                {{csrf_field()}}
                <legend>Create reply</legend>

                <div class="form-group">
                    <input type="text" class="form-control" name="body" id="" placeholder="reply...">
                </div>


                <button type="submit" class="btn btn-primary">Reply</button>
            </form>
            
        </div>
        <br>

        
        @foreach($comment->comments as $reply)
            
            <div class="small well reply-list" style="margin-left: 50px">
                <p>{{$reply->body}}</p>
                <lead> by {{$reply->user->username}}</lead>

                
                <div class="actions">
                    {{--<a href="{{route('thread.edit',$thread->id)}}" class="btn btn-info btn-xs">Edit</a>--}}
                    @if(auth()->user()->id == $reply->user_id)
                    <a class="btn btn-primary btn-xs" data-toggle="modal" href="#reply{{$reply->id}}">edit</a>
                    <div class="modal fade" id="reply{{$reply->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                                    </button>
                                    <h4 class="modal-title"></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="comment-form">

                                        <form action="{{route('comment.update',$reply->id)}}" method="post" role="form">
                                            {{csrf_field()}}
                                            {{method_field('put')}}
                                            <legend>Edit comment</legend>

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="body" id=""
                                                       placeholder="Input..." value="{{$reply->body}}">
                                            </div>


                                            <button type="submit" class="btn btn-primary">Reply</button>
                                        </form>

                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->


                    {{--//delete form--}}
                    <form action="{{route('comment.destroy',$reply->id)}}" method="POST" class="inline-it">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <input class="btn btn-xs btn-danger" type="submit" value="Delete">
                    </form>
                </div>
                @endif
            </div>

        @endforeach
        <br>
        
        
    @endforeach
    
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
            $('.reply-form-'+commentId).toggleClass('hidden');
        }
    </script>

@endsection
