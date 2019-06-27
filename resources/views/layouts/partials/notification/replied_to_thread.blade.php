<a href="{{route('thread.show',$notification->data['thread']['id'])}}">
    {{$notification->data['login']['username']}} commented on <strong> {{$notification->data['thread']['subject']}}</strong>
</a>