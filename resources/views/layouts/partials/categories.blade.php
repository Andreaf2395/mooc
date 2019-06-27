
	<div class="row">
		<form method="GET" action="/thread/search">
	        
	        <input type="search" name="query" placeholder="Search">
	        
	    </form>
	</div>

	<div class="row">
		<a class="waves-effect waves-light btn btn-large col s12 m12" href="{{route('thread.create')}}">Create thread</a>
	</div>
	<div class="row">
		<h4>Tags</h4>

		<div class="collection ">
			<a href="{{route('thread.index')}}" class="collection-item"><span class="badge green white-text">{{count(App\Model\thread::all())}}</span>
	    		All Threads
	    	</a>
			@foreach($tags as $tag)
	    	<a href="{{route('thread.index',['tags'=>$tag->id])}}" class="collection-item"><span class="badge green white-text">{{count($tag->threads)}}</span>
	    		{{$tag->name}}
	    	</a>
	    	@endforeach
		</div>
	</div>
	
