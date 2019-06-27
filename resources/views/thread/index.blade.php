@extends('layouts.front')

@section('heading')
@endsection


@section('content')
<div class="row col s12 m12">
@include('thread.partials.thread-list')
</div>
@endsection