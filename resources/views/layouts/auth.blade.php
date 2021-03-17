<!doctype html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title') | One Key</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito|Pacifico&display=swap">
    <link rel="stylesheet" href="{{asset('vendors/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/animate.css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/home/home.css')}}">
    @yield('head')
</head>
<body>
@yield('content')
<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/js/wow.js')}}"></script>
<script src="{{asset('js/home/home.js')}}"></script>
</body>
</html>
