@extends('layouts.main_layout')
@section('style')
<style>
	.collection-item > label > span{
		color:black;
	}
	.horizontal-line{
		margin: 0.5em 0 0.5em 0;
		border :0;
		height:1px;
		width:100%;
		display:block;
		background-color: blue;
		background-image:linear-gradient(to right,#DFE720,#1CD29A,#DFE720);
	}
	.subheader{
		 background-image: linear-gradient(to left, #e3ce86, #e1b47e, #d89c7b, #c8877b, #b1757b);
		 height: 12em;
	}
</style>


@section('content')
	
	<div class="row subheader"></div>


	<div class="container" style="margin-top: -7%;">
		<div class="card-panel green lighten-5">
			<div id="display"></div> 

			<form method="POST" action='/tasks/{{$mcqs[0]->task}}/savemcq'>
				@csrf
				
				@foreach($mcqs as $question)
				<div>
					<label for="{{$question->question_id}}"><b>{!!$question->question_text!!}</b><br></label>
				</div>
				<ul class="collection">
					<li class="collection-item " >
						<label>
			    			<input class="with-gap" type="radio" name="ques{{$question->question_id}}" id="ques{{$question->question_id}}_opt1" value="1"> 
			    			<span>{!!$question->option_1!!}</span><br>
			    		</label>
					</li>
					<li class="collection-item " >
						<label>
			    			<input class="with-gap" type="radio" name="ques{{$question->question_id}}" id="ques{{$question->question_id}}_opt2" value="2"> 
			    			<span>{!!$question->option_2!!}</span><br>
			    		</label>
					</li>	
					<li class="collection-item " >
						<label>
			    			<input class="with-gap" type="radio" name="ques{{$question->question_id}}" id="ques{{$question->question_id}}_opt3" value="3"> 
			    			<span>{!!$question->option_3!!}</span><br>
			    		</label>
			    	</li>	
			    	<li class="collection-item" >
			    		<label>
					    	<input class="with-gap" type="radio" name="ques{{$question->question_id}}" id="ques{{$question->question_id}}_opt4" value="4"> 
					    	<span>{!!$question->option_4!!}</span><br>
					    </label>
			    	</li>
				</ul>
			    
			    

			    <div class="horizontal-line"></div>
				<!--<li>{!!$question->question_text!!}</li>
				{!!$question->option_1!!}</li>-->
				@endforeach
				<br><br>
				<button type="submit" class="btn waves-effect waves-light" id="submitbtn" {{ ($disable_btn)?"disabled":"" }} >
					Submit
					<i class="material-icons right">send</i>
				</button> 
				<input type="hidden" name="time" id="time"/>
				<br><br>
				
			</form>
		</div>	



	 <div id="modal1" class="modal green">
		    <div class="row">
		      <div class="col s8 offset-s2 center">
		        <div class="modal-content" style="padding-top: 50px;
		        padding-bottom: 50px;">
		        <div><i class="material-icons large">school</i></div>
		        <span id="testTitle"></span>
		        <p>Quiz</p>
		        <a id="startbtn"  class="modal-action modal-close waves-effect blue-grey darken-4 btn">Start</a>
		      </div>
		    </div>
		  </div>
		</div>

 
	@section('scripts')
	<script>
		$( document ).ready(function() {
	    	var mcq_options = {!!json_encode($mcq_options)!!};
	    	var disable_btn={!!json_encode($disable_btn)!!};
	    	var duration = {!!json_encode($duration)!!};

	    	if(!disable_btn)
	    	{
		    	$('#modal1').modal({opacity: 1,});
		        $('#modal1').modal('open');
		    
			}
			else
			{
				$('input:radio').attr('disabled',true)
				for(var i=0;i<mcq_options.length;i++)
					$('#ques'+mcq_options[i].question_id+'_opt'+mcq_options[i].chosen_option).prop('checked',true);
			}

       		 

        	function SubmitFunction(){
       			$('form').submit();       
        	}

        			    
		

        	$('#startbtn').on('click',countDown(duration,$('#display')));

			function countDown(duration, display) {
				if(!disable_btn){
					$.ajax({
					           type: "GET",
					           url:'/tasks/1/emittrats',
					           cache:false,
					           processData: false,
			                   headers: {
			    					'X-CSRF-TOKEN': $('input[name="_token"]').attr('value') },
					           success: function(data)
					           {
					           		console.log('starting test');
					           },
					           error: function (xhr, status, error) {
					           	alert(xhr.responseText);
					           }   
					         });

					if (!isNaN(duration)) {
	                var timer = duration, minutes, seconds;
	                
	                var interVal=  setInterval(function () {
	                    minutes = parseInt(timer / 60, 10);
	                    seconds = parseInt(timer % 60, 10);
	                    minutes = minutes < 10 ? "0" + minutes : minutes;
	                    seconds = seconds < 10 ? "0" + seconds : seconds;
	                    $('#time').val(timer);
	                    $(display).html("<b>" + minutes + "m : " + seconds + "s" + "</b>");
	                    if (--timer < 0) {
	                        timer = duration;                        
	                        SubmitFunction();
	                        $('#display').empty();
	                        clearInterval(interVal);
	                    }
	                    },1000);
            		}
				}


        	}

		});

        /*function myFunction(){
        	if(mcq_options||deadline<today)
        		{
        	    	$("#submitbtn").attr("disabled", true);
        	    	$("#submitbtn").attr("class",'waves-effect darken-0 btn');
        	    }
        }*/


 		
	</script>
	@endsection
	
@stop


