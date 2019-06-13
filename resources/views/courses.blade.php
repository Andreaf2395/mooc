@extends('layouts.main_layout')

@section('style')
<style type="text/css">
  .border-btn{
  border:2px black solid;
  padding: 5px;
  color:black;
}

    .border-btn:hover{
        text-decoration: none;
        background-color: black;
        color:ghostwhite;
        transition: all 1s;
    }
    .button_content{
      display: flex;
      position: absolute;
      justify-content: space-between;
      bottom: 30px;
      right:30px;
    }
    
</style>

@stop
@section('content')
<div class="container">
    @if (session('error'))  
            <div class="card-panel red darken-4">{{ session('error') }}</div>
    @endif

    

	<div class="row " style="margin-top: 20px;">
    <div class="col s12 m8 offset-m2 ">
      <div class="card horizontal z-depth-5">
        <div class="card-image">
          <img src="images/vrep.png" style="height:150px; width:400px">
        </div>
        <div class="card-content">
          <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
          <div class="button_content">
            <a class="waves-effect waves-light border-btn">What's this course about</a>
            <a class="waves-effect waves-light btn" style="margin-left:5px;">Enroll</a>
          </div>
        </div>
      </div>
    </div>
  </div>
            
  <div class="row">
    <div class="col s12 m8 offset-m2">
      <div class="card horizontal z-depth-5">
        <div class="card-image">
          <img src="images/blender.png">
        </div>
        <div class="card-content">
          <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p><br>
          <div class="button_content">
            <a class="waves-effect waves-light border-btn">What's this course about</a>
            <a class="waves-effect waves-light btn" style="margin-left:5px;">Enroll</a>
          </div>
        </div>
      </div>
    </div>
  </div>
            

</div>




@stop

