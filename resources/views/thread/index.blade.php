@extends('layouts.front')

@section('heading')
<a class="btn btn-primary pull-right" href="{{route('thread.create')}}" style="position: absolute; right: 0;">Create thread</a><br><br>
@endsection

@section('content')





@include('thread.partials.thread-list')

@endsection