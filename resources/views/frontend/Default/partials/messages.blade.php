@if(isset ($messages) && count($messages) > 0)
    <div class="messages messages-info">{!! $messages[array_rand($messages)]; !!}</div>
@endif
@if(isset ($errors) && count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="messages messages-error">{!! $error !!}</div>
    @endforeach
@endif
