@if (count($errors) > 0)
    <div class="red-text" style="font-size: 14px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif