<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>OneKey - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/app-auth.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/animate.css')}}">
</head>
<body>
<div id="app">
    <header class="py-5">
        @include('auth.components.header')
    </header>
    <main class="py-3">
        @yield('content')
    </main>
</div>
<script src="{{asset('js/app.js')}}" defer></script>
<script src="{{asset('vendors/js/all.js')}}" defer></script>
<script src="{{asset('vendors/js/wow.js')}}" defer></script>
<script src="{{asset('js/auth/auth.js')}}" defer></script>
</body>
</html>
