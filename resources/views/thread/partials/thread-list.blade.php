@section('script')
	<style>
	.card{
		font-size:20px !important;
		}
	</style>
@endsection
<div class="list-group">

	@forelse($threads as $thread)

        <a href="{{route('thread.show',$thread->id)}}" style="text-decoration: none;">
        	<div class="card blue-grey lighten-5">
        		<div class="card-content black-text">
                <h5> {{$thread->subject}}</h5>
            
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