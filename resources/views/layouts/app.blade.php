<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Videotheek')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header class="container">
        <h1><a href="/">Videotheek</a></h1>
    </header>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
