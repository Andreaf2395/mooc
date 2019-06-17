@extends('layouts.main_layout')
@section('style')
<style type="text/css">
    .tabs .tab a{
            color:green;
        } /*Black color to the text*/

        .tabs .tab a:hover {
            background-color:#e8f5e6;;
            color:#09ab3d;
        } /*Text color on hover*/

        .tabs .tab a.active {
            background-color:#e8f5e6 !important;
            color:#09ab3d;
        } /*Background and text color when a tab is active*/

        .tabs .indicator {
            background-color:#2bb986;
        } /*Color of underline*/
</style>
@stop

@section('content')
  
<div class="container" style="margin-top:30px;">

@if (session('error'))  
    <div class="card-panel red darken-4">{{ session('error') }}</div>
@endif


    <div class="row">
            <ul  class=" tabs" >
            <li class="tab col s4 "><a class="active" href="#overview">Overview</a></li>
            <li class="tab col s4"><a href="#mcq">MCQ</a></li>
            <li class="tab col s4"><a href="#assign">Assignment</a></li>
        </ul>

        <!--Overview- -->
        <div id="overview" class="col s12 " style="height:400px;padding-top:30px;">
            <div class="card col s12 m10 offset-m1" style="padding:20px;" >
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
        </div>

    

        <div id="mcq" class="col s12 " style="padding-top:30px;" >
            <div class="card col s12 m10 offset-m1" style="padding-bottom:20px;">
                <div class="section">
                    <h5 class="teal-text">Instructions:</h5>
                    <p> instructions go here</p>
                </div>
                <div class="divider"></div>

                <div class="section">
                    @if(!$team_mcq_score)
                        <a class="waves-effect waves-light btn" href="/tasks/{{$task->task_id}}/mcq">Take Quiz</a>
                    @else
                        <div class="col s12 m4 center-align" >
                            <div class="chip teal-text" style="font-size: 16px;">Your Score: {{$team_mcq_score->mcq_score}}</div>
                        </div>
                        <div class="col s12 m4 center-align" >
                            <div class="chip teal-text" style="font-size: 16px;">Time taken: {{$team_mcq_score->mcq_duration}} seconds</div>
                        </div>
                        <div class="col s12 m4 center-align">
                            <a class="waves-effect waves-light btn" href='/tasks/1/mcq'>Review your Answers</a>
                        </div>
                        
                        
                        
                    @endif
                </div>
                
            </div>
        </div>
        
        <div id="assign" class="col s12 "  style="padding-top:30px;" >
            <div class="card col offset-m1 m10 ">
                <div class="section">
                    <h5 class="teal-text">Instructions:</h5>
                    <p> instructions go here</p>
                </div>
                <div class="divider"></div>

                <div class="section">
                    <h5 class="teal-text">Submission:</h5>
                        <div>
                            @if (session('message'))            
                            <div class="card-panel green darken-1">
                                {{ session('message') }}
                            </div>
                        <br>
                        @endif

                        <form method="POST" action="/tasks/1/assign" enctype="multipart/form-data">
                            @csrf
                          
                            <div class="input-field col s12 m5">
                                <select name="submission_type" id="submission_type">
                                    <option value=''></option>
                                    @foreach($submission_types as $submission_type)
                                    <option value='{{ $submission_type->id }}'>{{ $submission_type->type }}</option>
                                    @endforeach
                                </select>
                                <label for="submission_type">Select submission types</label>
                            </div>

                           <div class="input-field col s12 m12 " id="file_input" style="display: none;">
                                <label for="assignment"></label>
                                <input type="file" placeholder="Upload your assignment" name="assignment1" required>
                           </div>

                           <div class="input-field col s12 m12 " id="link_input" style="display: none;">
                                <label for="assignment"></label>
                                <input type="text" placeholder="Insert link here" name="assignment2" required>
                           </div>               
                        
                           <div class="input-field col s12 m12">
                                <button type="submit" class="waves-effect waves-light btn modal-trigger" id="submitbtn" {{ ($time_up)?"disabled":"" }}>Submit
                                <i class="material-icons right">send</i>
                            </button>
                           </div>
                            

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

            </div>
                    
        </div>

    </div>

</div>


  
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.tabs').tabs();
            $('select').formSelect();

            $('submitbtn').on('click',function(){
                alert('dfsdf');
            });


            $('#submission_type').on('change',function(){
                let subm_type=$('#submission_type').val();
                if(subm_type == 2){
                   $('#file_input').hide();
                   $('#link_input').show(); 
                }
                else
                {
                    $('#file_input').show();
                    $('#link_input').hide(); 
                } 
            });
        });
    </script>
@stop