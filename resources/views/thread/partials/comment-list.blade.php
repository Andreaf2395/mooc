<h4>{{$comment->body}}</h4>

@if(!empty($thread->solution))
    @if($thread->solution == $comment->id)
        <button class="btn btn-success pull-right">Solution</button>
    @endif
@else
    @if(auth()->check())
        @if(auth()->user()->id == $thread->login_id)
            <form action="{{route('markAsSolution')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="threadId" value="{{$thread->id}}">
                <input type="hidden" name="solutionId" value="{{$comment->id}}">
                <input type="submit" class="btn btn-success pull-right" id="{{$comment->id}}" value="Mark As Solution">
            </form>
        @endif
    @endif
@endif

<lead>by {{$comment->user->username}}</lead>

<div class="actions">
    
    <button class="btn btn-default btn-xs blue-grey lighten-4 black-text" id="{{$comment->id}}-count" >{{$comment->likes()->count()}}</button>
    <span class="btn btn-info btn-xs {{$comment->isLiked()?'liked':''}}" onclick="likeIt('{{$comment->id}}',this)"><span class="glyphicon glyphicon-thumbs-up"></span></span>
    
    @if(auth()->user()->id == $comment->user_id)
    <!--<a href="{{route('thread.edit',$thread->id)}}" class="btn btn-info btn-xs">Edit</a>-->
    <a class="btn btn-primary btn-xs" data-toggle="modal" href="#com{{$comment->id}}">edit</a>
    <div class="modal fade bd-example-modal-lg" id="com{{$comment->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="comment-form">

                        <form action="{{route('comment.update',$comment->id)}}" method="post" role="form">
                            {{csrf_field()}}
                            {{method_field('put')}}
                            <legend>Edit comment</legend>

                            <div class="form-group">
                                <input type="text" class="form-control" name="body" id=""
                                       placeholder="Input..." value="{{$comment->body}}">
                            </div>


                            <button type="submit" class="btn btn-primary">Comment</button>
                        </form>

                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    {{--//delete form--}}
    <form action="{{route('comment.destroy',$comment->id)}}" method="POST" class="inline-it">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <input class="btn btn-xs btn-danger" type="submit" value="Delete">
    </form>
    @endif
</div>


@section('js')
    <script>

        function likeIt(commentId,elem){
            var csrfToken='{{csrf_token()}}';
            var likesCount=parseInt($('#'+commentId+"-count").text());
            $.post('{{route('toggleLike')}}', {commentId: commentId,_token:csrfToken}, function (data) {
                console.log(data);
                if(data.message==='liked'){
                    $(elem).addClass('liked');
                    $('#'+commentId+"-count").text(likesCount+1);
                    //$(elem).css({background:'green'});
                }else{
                    //$(elem).css({background:''});
                    $('#'+commentId+"-count").text(likesCount-1);
                    $(elem).removeClass('liked');
               }
            });
        }


        function toggleReply(commentId){
            $('.reply-form-'+commentId).toggleClass('hidden');
        }

    </script>
@endsection