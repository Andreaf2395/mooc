@extends('layouts.front')

@section('heading',"Edit Thread")

@section('content')

	

	<div class="row col-md-12">
            <form action="{{route('thread.update',$thread->id)}}" method="post" 
                  id="create-thread-form">
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="input-field col s12">  
                    <input type="text" class="form-control" name="subject" id="" placeholder="Input..." value="{{$thread->subject}}">
                    <label for="subject">Subject</label>       
                </div>

                <div class="form-group">
                    <label for="tag">Tags</label>
                    <select name="tags[]" multiple id="tag">
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-field col s12">
                    <textarea class="materialize-textarea" name="thread" id="" placeholder="Input...">{{$thread->thread}}</textarea>
                    <label for="thread">Thread</label>
                </div>
          
                <button type="submit" class="waves-effect waves-light btn">Submit</button>
            </form>
    </div>

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>

    <script>
        $(function () {
            $('#tag').selectize();
        })
    </script>
@endsection