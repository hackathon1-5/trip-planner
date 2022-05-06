<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet"
</head>
<body>
<article>
    <h1>Trip Planner</h1>
    <p>Where do you want to go?</p>
    <form method="get">
        <input type="text" />
    </form>
    <ul>

    @foreach ($places as $place)
        <li>{{ $place->name }}</li>
    @endforeach

    </ul>
</article>
</body>
</html>
