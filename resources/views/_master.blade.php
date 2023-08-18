<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="@yield('html-class')">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    @vite('resources/js/app.js')
</head>

<body class="@yield('body-class')">
@yield('content')
</body>

</html>
