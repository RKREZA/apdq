<!DOCTYPE html>
<html>
<head>
    <title>Ashrayan - 2</title>
</head>
<body>
    {{ $details['title'] }}
    {!! $details['body'] !!}

    <hr>
    <img src="/{{ auth()->user()->signature }}" alt="" style="height: 80px; width:300px">
    <p>{{ auth()->user()->name }}</p>
    <p>{{ auth()->user()->designation }}</p>
    <p>{{ auth()->user()->email }}</p>
    <p>{{ auth()->user()->mobile }}</p>
</body>
</html>
