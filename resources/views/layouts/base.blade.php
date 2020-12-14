<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>User Agents</title>
</head>
<body>
    @include('components.header')

    @yield('content')

    @include('components.footer')
</body>
</html>
