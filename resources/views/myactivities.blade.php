<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel - User Activities</title>
</head>
<body>
    <h2>My Activities</h2>
    @auth

        @foreach (auth()->user()->activities->all() as $item)
            <p>{{ $item->name }}</p>
        @endforeach

    @endauth
</body>
</html>
