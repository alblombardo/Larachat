@if($messages = session('alerts'))

    @push('scripts')
        <script>
            $('.flash-message.tmp').delay(3000).fadeOut(1000);
        </script>
    @endpush
    @foreach($messages as $message)
        <div class="alert mdl-alert flat alert-{{$message['type'] or 'info'}} @isset($message['tmp']) tmp @endisset flash-message"
             role="alert">
            {{$message['message']}}
        </div>
    @endforeach
@endif
@if($status = session('status'))
    <div class="alert mdl-alert alert-success flat" role="alert">
        <p>{{ $status }}</p>
    </div>
@endif
@if ($errors->any())
    <div class="alert mdl-alert alert-danger flat" role="alert">
        @if($errors->count() > 1)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-center">{{ $errors->first() }}</p>
        @endif

    </div>
@endif