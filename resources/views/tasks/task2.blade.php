@extends('layouts.main_layout')


@section('content')
	
<div class="container" style="margin-top:30px;">
	<ul id="tabs-swipe-demo" class=" tabs" >
    <li class="tab col s3"><a class="active text-teal" href="#overview">Overview</a></li>
    <li class="tab col s3"><a href="#mcq">MCQ</a></li>
    <li class="tab col s3"><a href="#assign">Assignment</a></li>
  </ul>
  <div id="overview" class="col s12  light-blue lighten-5">Overview</div>
  <div id="mcq" class="col s12  light-blue lighten-4">MCQ</div>
  <div id="assign" class="col s12  light-blue lighten-3 ">Assignment</div>
</div>

	
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
    $('.tabs').tabs();
  });
</script>
@stop