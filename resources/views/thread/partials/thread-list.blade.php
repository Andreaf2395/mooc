<div class="list-group">
	<!--@forelse($threads as $thread)
		<a href="{{route('thread.show',$thread->id)}}" class="list-group-item">
			<h4 class="list-group-item-heading">{{$thread->subject}}</h4>
			<p class="list-group-item-text">{{str_limit($thread->thread,100)}}</p>
		</a>
	@empty
		<h5>No thread</h5>
	@endforelse-->

	@forelse($threads as $thread)

        <a href="{{route('thread.show',$thread->id)}}" style="text-decoration: none;">
        	<div class="card blue-grey lighten-5">
        		<div class="card-content black-text">
                <h3> {{$thread->subject}}</h3>
            
                <p>{{str_limit($thread->thread,100) }}
                    <br>
                    <h6>Posted by {{$thread->login->username}} {{$thread->created_at->diffForHumans()}}</h6>
                </p>
            	</div>
            </div>
    	</a>

    @empty
        <h5>No threads</h5>

    @endforelse
</div>