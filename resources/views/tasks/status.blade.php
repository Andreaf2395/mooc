@extends('layouts.main_layout')


@section('content')
	
	<div class="container">
		<div class="card blue-grey lighten-4">
	    	<div class="card-content black-text">	
			<span class="card-title center">Team Status</span>
			<br>
				<table class="striped centered">
			        <thead>
			          <tr>
			              <th>Task</th>
			              <th>MCQ</th>
			              <th>Assignment</th>
			              <th>Score</th>
			          </tr>
			        </thead>

			        <tbody>
						@for($i=0;$i<3;$i++)	
							<tr>
								<td>{{$i+1}}</td>
								@if($task_statuses[$i]==1 || $task_statuses[$i]==3)
									<td><i class="material-icons">check</i></td>
								@else
									<td>not submitted</td>
								@endif
								@if($task_statuses[$i]==2 || $task_statuses[$i]==3)
									<td><i class="material-icons">check</i></td>
								@else
									<td>not submitted</td>
								@endif
								@if($task_statuses[$i])
									<td>{{$scores[$i]}}</td>
								@else
									<td>0</td>
								@endif
							</tr>
						@endfor	          
			        </tbody>
			    </table>
			</div>
		</div>
	  
	</div>

 
	@section('scripts')
	<script>

 		
	</script>
	@endsection
	
@stop