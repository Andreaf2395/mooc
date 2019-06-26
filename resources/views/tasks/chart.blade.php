@extends('layouts.main_layout')


@section('content')
	
	<h3><center>Progress</center></h3>
	<br>
	<div class="container" style="height: 300px; width: 300px;">
		<canvas id="myChart1" style="height: 100px; width: 100px;"></canvas>
	</div>
	<br><br>
	<div class="container" style="height: 600px; width: 600px;">
		<canvas id="myChart2" style="height: 400px; width: 600px;"></canvas>
	</div>

 
	@section('scripts')
	<script>
		
		//for team status graph
		var ctx1 = document.getElementById('myChart1').getContext('2d');
		
		var myChart1 = new Chart(ctx1, {
		    type: 'bar',
		    data: {
		        labels: ['0-2', '3-4','5-6','7-8','9-10'],
		        datasets: [{
		            label: '# of teams',
		            backgroundColor: "",
					borderColor: "blue",
					borderWidth: 1,
		            data: {!!json_encode($score_counts)!!},
		            borderWidth: 1
		        }]
		    },
		    options: {
		    	title:{
		    		display:true,
		    		text:"Task Result"
		    	},
		    	legend:{
		    		display:false
		    	},
		        scales: {
		            xAxes: [{
		            	scaleLabel: {
				            display: true,
				            labelString: 'Score'
				          }
		            }],
		            yAxes: [{
		                ticks: {
		                    beginAtZero: true
		                }
		            }]
		        }
		    }
		});
		

		//for each mcq question
		var barChartData = {
			labels: [
				"Q1",
				"Q2",
				"Q3",
				"Q4",
				"Q5"
			],
			datasets: [
			{
				label: "Not attempted",
				backgroundColor: "lightblue",
				borderColor: "blue",
				borderWidth: 1,
				data: {!!json_encode($unattempted)!!}
			},
			{
				label: "Attempted and wrong",
				backgroundColor: "pink",
				borderColor: "red",
				borderWidth: 1,
				data: {!!json_encode($attempted_and_wrong)!!}
			},
			{
				label: "Attempted and right",
				backgroundColor: "lightgreen",
				borderColor: "green",
				borderWidth: 1,
				data: {!!json_encode($attempted_and_right)!!}
			}
			]
		};

		var chartOptions = {
			responsive: true,
			legend: {
				position: "top"
			},
			title: {
				display: true,
				text: "MCQ Result"
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}

		window.onload = function() {
			var ctx2 = document.getElementById("myChart2").getContext("2d");
			var myChart2 = new Chart(ctx2, {
				type: "bar",
				data: barChartData,
				options: chartOptions
			});
		};


 		
	</script>
	@endsection
	
@stop