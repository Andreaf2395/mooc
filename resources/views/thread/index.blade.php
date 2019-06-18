@extends('layouts.front')

@section('heading')
	<a class="waves-effect waves-light btn" href="{{route('thread.create')}}">Create thread</a><br><br>
@endsection
@section('content')
	@include('thread.partials.thread-list')

@endsection