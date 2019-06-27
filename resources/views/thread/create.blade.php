@extends('layouts.front')

@section('heading',"Create Thread")

@section('content')
    @include('layouts.partials.error')
    @include('layouts.partials.success')
    

    <div class="row">
        
            <form  action="{{route('thread.store')}}" method="post" id="create-thread-form">
                {{csrf_field()}}
                <div class="input-field col s12">
                    <input type="text" class="form-control" name="subject" id="" value="{{old('subject')}}">
                    <label for="subject">Subject</label>       
                </div>

                <div class="input-field col s12">
                    <label for="tag">Tags</label>
                    <select name="tags[]" multiple id="tag">
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-field col s12">           
                    <textarea class="materialize-textarea" name="thread">{{old('thread')}}</textarea>
                    <label for="thread">Thread</label>
                </div>

                <div class="input-field col s12">
                    {!!NoCaptcha::renderJs()!!}
                    {!!NoCaptcha::display()!!}
                </div>

                <div class="input-field col s12">
                    <button type="submit" class="waves-effect waves-light btn">Submit</button>
                </div>
                
            </form>
        
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>
    
    <script>
        $(function () {
            $('#tag').selectize({
    delimiter: ',',
    persist: false,
    create: function(input) {
        return {
            value: input,
            text: input
        }
    }
});
        })
    </script>
@endsection