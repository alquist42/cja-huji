<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Find tech jobs and companies in the Bay Area.">
    <meta name="keywords" content="Talent acquisition, job hunting, startups, San Francisco Bay Area, Silicon Valley">
    <meta name="author" content="Connor Leech">
    <meta name="base" content="Connor Leech">


    <title>Employbl SPA</title>

    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

<div id="app" class="leading-normal tracking-normal gradient">
    <router-view></router-view>
</div>

<script src="/js/browse.js"></script>
</body>

</html>
