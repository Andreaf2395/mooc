@section('script')
	<style>
	.card{
		font-size:20px !important;
		}
	</style>
@endsection
<div class="list-group">

	@forelse($threads as $thread)
        <div class="row">
            <a href="{{route('thread.show',$thread->id)}}" style="text-decoration: none;">
        	   <div class="card blue-grey lighten-5 ">
        		<div class="card-content black-text">

                    <span class="card-title teal-text z-depth-1">{{$thread->subject}}</span>

            
                    <p>{{str_limit($thread->thread,100) }}
                      </p>  
                    <h6 class="grey-text" style="font-size:13px;">Posted by {{$thread->login->username}} {{$thread->created_at->diffForHumans()}}</h6>
                
            	</div>
                </div>
    	   </a>
    </div>
    
      
    @empty
        <h5>No threads</h5>

    @endforelse
</div>