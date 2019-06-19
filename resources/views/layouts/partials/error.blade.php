@if (count($errors) > 0)
    <div class="card-panel red darken-1">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif