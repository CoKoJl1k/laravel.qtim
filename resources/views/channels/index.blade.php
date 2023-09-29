@extends('home')

@section('content')

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher('d4e20b474d2e2e37e7f8', {
            cluster: 'eu'
        });
        var channel = pusher.subscribe('chat');
        channel.bind('NewMessage', function(data) {
           // console.log(data.message);
            alert(JSON.stringify(data));
        });
    </script>
@endsection

