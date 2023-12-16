<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel - User Activities</title>
</head>
<body>
    <header>
        <div>
            My Activities - User name: {{$username}}
        </div>
        <nav>
            <input type="text" place>
        </nav>
    </header>

    @auth

        <ul>
            @foreach ($activities as $item)
            <li>{{ $item->name }}</li>
            @endforeach
        </ul>

    @endauth
</body>
</html>
