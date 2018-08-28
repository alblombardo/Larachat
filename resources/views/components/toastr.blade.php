@if($messages = session('alerts'))
    @foreach($messages as $message)
        @push('scripts')
            <script>toastr.{{$message['type'] or 'info'}}('{{$message['message']}}')</script>
        @endpush
    @endforeach
@endif
@if (isset($errors))
    @foreach ($errors->all() as $error)
        @push('scripts')
            <script>toastr.error('{{$error}}')</script>
        @endpush
    @endforeach
@endif