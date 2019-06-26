<div class="col-md-3">
	
	<form method="GET" action="/search">
        
        <input type="text" name="query" placeholder="Search">
        
    </form>

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
	    <!--<a href="#!" class="collection-item"><span class="new badge">2</span>Laravel</a>
	    <a href="#!" class="collection-item"><span class="new badge">2</span>Javascript</a>-->
	</div>
	

	<!-- <ul class="list-group">
		<a href="{{route('thread.index')}}" class="list-group-item">
			<span class="new badge green">14</span>
			All thread
		</a>
		<a href="#" class="list-group-item">
			<span class="new badge green">2</span>
			Laravel
		</a>
		<a href="#" class="list-group-item">
			<span class="new badge green">1</span>
			Javascript
		</a>
	</ul> -->
</div>