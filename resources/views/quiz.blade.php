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
@stop

@section('content')
	<div class="row subheader"  >

	</div>

	<div class="container " style="margin-top: -7%;">
		<div class="card-panel amber lighten-5">
			<div>
				<div class="question " >
					<p><strong>Q1.</strong> Download the .hex file from <a class="btn-small " href="/ques1"> here.</a> Load this file onto your robot and observe the output on the LCD. Select the output that you observe.</p>
				</div>
				<ul class="collection">
					<li class="collection-item " id="o1">
						<label>
	        				<input class="with-gap option" name="group1" id="1" value="1" type="radio"  />
	        				<span>Green</span>
	      				</label>
					</li>
					
	      			<li class="collection-item" id="o2">
						<label>
	        				<input class="with-gap option" name="group1" id="2" value="2" type="radio"  />
	        				<span>Green</span>
	      				</label>
					</li>
					<li class="collection-item" id="o3">
						<label>
	        				<input class="with-gap option" name="group1" id="3" value="3" type="radio"  />
	        				<span>Green</span>
	      				</label>
					</li>
					<li class="collection-item" id="o4">
						<label>
	        				<input class="with-gap option" name="group1" id="4" value="4" type="radio"  />
	        				<span>Green</span>
	      				</label>
					</li>
					

				</ul>	
			</div>
			<div class="horizontal-line">
			</div>
			<div>
				<div class="question " >
					<p><strong>Q1.</strong> Download the .hex file from <a class="btn-small " href="/ques1"> here.</a> Load this file onto your robot and observe the output on the LCD. Select the output that you observe.</p>
				</div>
				<ul class="collection">
					<li class="collection-item " id="o1">
						<label>
	        				<input class="with-gap option" name="group2" id="21" value="1" type="radio"  />
	        				<span>Green</span>
	      				</label>
					</li>
					
	      			<li class="collection-item" id="o2">
						<label>
	        				<input class="with-gap option" name="group2" id="22" value="2" type="radio"  />
	        				<span>Green</span>
	      				</label>
					</li>
					<li class="collection-item" id="o3">
						<label>
	        				<input class="with-gap option" name="group3" id="23" value="3" type="radio"  />
	        				<span>Green</span>
	      				</label>
					</li>
					<li class="collection-item" id="o4">
						<label>
	        				<input class="with-gap option" name="group4" id="24" value="4" type="radio"  />
	        				<span>Green</span>
	      				</label>
					</li>
					

				</ul>	
			</div>
		
		
		</div>
	</div>
	


	
@stop

@section('scripts')
<script>
	$(document).ready(function(){
		$('.option').on('click',function(){
			
			let sel_opt=$(this).val();
			$(this).parent().parent().addClass('light-green lighten-3');
			checked(1,sel_opt);
		});



		function checked_option(question_id,option_id)
    {

        $('#'+option_id).prop('checked',true);
        switch(option_id)
        {
            case 1: $('#l'+question_id+option_id).addClass('light-green lighten-3');
                    $('#l'+question_id+'2').removeClass('light-green lighten-3')
                    $('#l'+question_id+'3').removeClass('light-green lighten-3')
                    $('#l'+question_id+'4').removeClass('light-green lighten-3')
                    break;
            case 2: $('#l'+question_id+option_id).addClass('light-green lighten-3');
                    $('#l'+question_id+'1').removeClass('light-green lighten-3');
                    $('#l'+question_id+'3').removeClass('light-green lighten-3');
                    $('#l'+question_id+'4').removeClass('light-green lighten-3');
                    break;
            case 3: $('#l'+question_id+option_id).addClass('light-green lighten-3');
                    $('#l'+question_id+'1').removeClass('light-green lighten-3');
                    $('#l'+question_id+'2').removeClass('light-green lighten-3');
                    $('#l'+question_id+'4').removeClass('light-green lighten-3');
                    break;
            case 4: $('#l'+question_id+option_id).addClass('light-green lighten-3');
                    $('#l'+question_id+'1').removeClass('light-green lighten-3');
                    $('#l'+question_id+'2').removeClass('light-green lighten-3');
                    $('#l'+question_id+'3').removeClass('light-green lighten-3');
        }
    }    

		
	});
</script>
@stop