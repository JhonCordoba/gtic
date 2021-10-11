<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GTIC</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    
</head>

<body>
    @include('layouts.partials.modal_fade')
    @include('layouts.partials.nav_bar')

    @yield("content")

    <script src="{{ asset('js/libraries/charts_loader.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>