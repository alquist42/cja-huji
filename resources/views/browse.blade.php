<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>The Bezalel Narkiss Index of Jewish Art</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="http://cja.huji.ac.il/favicon.ico" type="image/x-icon" />

    <!-- Scripts -->
    <script>

    </script>
</head>
<body>

    @include('partials.header')

    <div id="app" class="leading-normal tracking-normal gradient" data-project="{{ request()->project }}">
        <router-view></router-view>
    </div>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/browse.js') }}"></script>
</body>

</html>
