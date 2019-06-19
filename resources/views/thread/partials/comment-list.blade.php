
<div class="horizontal-divider"></div>
<br><br>
<div class="author"> {{$comment->user->username}} &nbsp;&nbsp;&nbsp;<i class="tiny material-icons">access_time</i>&nbsp;&nbsp;{{$thread->created_at->diffForHumans()}}</div>
<div style="float:right;">
    @if(!empty($thread->solution))
        @if($thread->solution == $comment->id)
            <div class="chip teal">Solution</div>
    @endif
    @else
        @if(auth()->check())
            @if(auth()->user()->id == $thread->login_id)
                <form action="{{route('markAsSolution')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="threadId" value="{{$thread->id}}">
                    <input type="hidden" name="solutionId" value="{{$comment->id}}">
                    <input type="submit" class="btn btn-small" id="{{$comment->id}}" value="Mark As Solution">
                </form>
            @endif
        @endif
    @endif
</div>

<div class="row" style="margin-bottom: 0;">
    <div class="col s1 m1" style="padding-top:20px;">
        <div class="chip" id="{{$comment->id}}-count" >{{$comment->likes()->count()}}</div>
    </div>
    <div class="col s11 m11">
        <blockquote style="word-wrap: break-word;">{{$comment->body}}</blockquote>
    </div>

</div>





<div>
    
    <div class="btn-floating btn-small waves-effect waves-light {{$comment->isLiked()?'green':'grey lighten-1'}}" onclick="likeIt('{{$comment->id}}',this)"><i class="tiny material-icons">thumb_up</i></div>

    
    @if(auth()->user()->id == $comment->user_id)
    <!--<a href="{{route('thread.edit',$thread->id)}}" class="btn btn-info btn-xs">Edit</a>-->
    <a class="btn-floating btn-small waves-effect waves-light blue modal-trigger"  href="#com{{$comment->id}}"><i class="material-icons small">edit</i></a>
    <div class="modal " id="com{{$comment->id}}">
        <div class="modal-content">
            <h4>EDIT the comment</h4>
            <form action="{{route('comment.update',$comment->id)}}" method="post" >
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="input-field col s6">
                    <textarea type="text" class="materialize-textarea" name="body" id="" >{{$comment->body}}</textarea>        
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-small ">Save</button>
                </div>
            </form>   
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->

    {{--//delete form--}}
    <form action="{{route('comment.destroy',$comment->id)}}" method="POST" class="action-element">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <button class="btn-floating btn-small waves-effect waves-light red" type="submit" value="Delete"><i class="material-icons small">delete</i></button>
    </form>
    @endif

    <button  class="btn btn-small" id="reply-btn-{{$comment->id}}" onclick="toggleReply('{{$comment->id}}')"> reply</button>
                <!--reply to comment-->
        <div id="reply-form-{{$comment->id}}" class="reply-form col m10 offset-m2" style="display: none;">
            
            <form action="{{route('replycomment.store',$comment->id)}}" method="post" >
                {{csrf_field()}}
                <div class="input-field col s12 m12">
                    <textarea class="materialize-textarea" name="body" id=""></textarea>
                </div>
                <button type="submit" class="btn ">Reply</button>
            </form>
            
        </div>
</div>


@section('js')
    <script>
           $(document).ready(function(){
            $('.modal').modal();

        });
       

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


            function toggleReply(commentid){
                 $('#reply-form-'+commentid).toggle();
            }

    </script>
@endsection