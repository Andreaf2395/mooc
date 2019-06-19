@if (session('message'))            
	<div class="card-panel green darken-1">
	    {{ session('message') }}
	</div>
@endif