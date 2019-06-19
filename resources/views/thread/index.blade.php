@extends('layouts.front')

@section('heading')
<a class="waves-effect waves-light btn col right" href="{{route('thread.create')}}">Create thread</a>
@endsection

@section('content')

@include('thread.partials.thread-list')

@endsection