<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($header['title']) ? "{$header['title']} | Historic Synagogues of Europe" : 'Historic Synagogues of Europe' }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="http://cja.huji.ac.il/favicon.ico" type="image/x-icon"/>

{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.5.0/viewer.min.css" integrity="sha256-MpORFsKmYYmQvFqOG/2AbIcy09vQBwjfZDKM+Ri/m0Y=" crossorigin="anonymous" />--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.5.0/viewer.min.js" integrity="sha256-mLJW+YLWH/4ebMAdPKIX1aTCIE0m2nInDT1NxX8TCBM=" crossorigin="anonymous"></script>--}}

<!-- Scripts -->
    <script>

    </script>
</head>
<body>

@include('mhs.partials.header')
<main>
    <div id="app" class="container">
        @yield('content')
    </div>
</main>
@include('partials.footer')

<!-- Scripts -->
<script src="{{ asset('js/mhs.js') }}"></script>
</body>
</html>