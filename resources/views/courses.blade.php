@extends('layouts.main_layout')

@section('style')
<style type="text/css">
  
    
</style>

@stop
@section('content')
<div class="container">
    @if (session('error'))  
            <div class="card-panel red darken-4">{{ session('error') }}</div>
    @endif

    

	<div class="row " style="margin-top: 20px;">
    <div class="col s12 m8 offset-m2 ">
      <div class="card horizontal z-depth-2">
        <div class="card-image">
          <img src="images/vrep.png" style="height:150px; width:400px">
        </div>
        <div class="card-content">
          <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
          <br>
          <div class="card-action right-align">
            <a class="waves-effect waves-light border-btn" href="/tasks/1">What's this course about</a>
            <a class="waves-effect waves-light btn" style="margin-left:5px;">Enroll</a>
          </div>
        </div>
      </div>
    </div>
  </div>
            
  <div class="row">
    <div class="col s12 m8 offset-m2">
      <div class="card horizontal z-depth-2">
        <div class="card-image">
          <img src="images/blender.png">
        </div>
        <div class="card-content ">
          <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p><br>
          <div class="card-action right-align">
            <a class="waves-effect waves-light border-btn" href="/tasks/1">What's this course about</a>
            <a class="waves-effect waves-light btn" style="margin-left:5px;">Enroll</a>
          </div>
        </div>
      </div>
    </div>
  </div>
            

</div>




@stop

