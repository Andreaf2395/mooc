@extends('layouts.front')

@section('heading',"create thread")

@section('content')
     @include('layouts.partials.error')
    @include('layouts.partials.success')
    

    <div class="row">
        <div class="col-md-12">
            <form  action="{{route('thread.store')}}" method="post" 
                  id="create-thread-form">
                {{csrf_field()}}
                <div class="input-field col s12">
                    <input type="text" class="form-control" name="subject" id="" placeholder="Input..."
                           value="{{old('subject')}}">
                    <label for="subject">Subject</label>       
                </div>

                <div class="input-field col s12">
                    <input type="text" class="form-control" name="type" id="" placeholder="Input..." value="{{old('type')}}">
                    <label for="type">Type</label>
                </div>

                <div class="input-field col s12">           
                    <textarea class="materialize-textarea" name="thread" id="" placeholder="Input...">{{old('thread')}}</textarea>
                    <label for="thread">Thread</label>
                </div>

                <div class="input-field col s12">
                    {!!NoCaptcha::renderJs()!!}
                    {!!NoCaptcha::display()!!}
                </div>

                <button type="submit" class="waves-effect waves-light btn">Submit</button>
            </form>
        </div>
    </div>

@endsection