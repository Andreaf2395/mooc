@extends('layouts.main_layout')


@section('content')
  
<div class="container" style="margin-top:30px;">
    <ul id="tabs-swipe-demo" class=" tabs" >
        <li class="tab col s3"><a class="active text-teal" href="#overview">Overview</a></li>
        <li class="tab col s3"><a href="#mcq">MCQ</a></li>
        <li class="tab col s3"><a href="#assign">Assignment</a></li>
    </ul>

    <div id="overview" class="col s12  light-blue lighten-5">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </div>

    
    @if(!$team_mcq_score)
    <div id="mcq" class="col s12  light-blue lighten-4">
        <a href="/tasks/{{$task->task_id}}/mcq">Take Quiz</a>
    </div>


    @else
    <div id="mcq" class="col s12  light-blue lighten-4">
        <p>your Score: {{$team_mcq_score->mcq_score}}</p>
        <p>Time taken: {{$team_mcq_score->mcq_duration}} seconds</p>
    </div>

    @endif
    
    
    <div id="assign" class="col s12  light-blue lighten-3 ">

        <form method="POST" action="/tasks/{{$task->task_id}}/assign" enctype="multipart/form-data">
            @csrf
            <h6>Select submission types</h6>
            
            <select name="submission_type">
                @foreach($submission_types as $submission_type)
                <option value='{{ $submission_type->id }}'>{{ $submission_type->type }}</option>
                @endforeach
            </select>

            <label>Select submission type</label>

            <label for="assignment"><b>Photo</b></label>
            <input type="file" placeholder="Upload your assignment" name="assignment" required>
            <br><br>
            <button type="submit" data-target="modal1" class="waves-effect waves-light btn modal-trigger" id="submitbtn" {{ ($time_up)?"disabled":"" }}>
                    Submit
                    <i class="material-icons right">send</i>
            </button>

            @if($errors->any())
                <ul>
                @foreach($errors->all() as $error)
                    <li >{{$error}}</li>
                @endforeach
                </ul>
            @endif

        </form>
    
    </div>

</div>

<div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>
  
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
        $('.tabs').tabs();
        });

        (function($){ 
            $(function(){
            $('select').formSelect();
            });
        })(jQuery);

        $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });


    </script>
@stop