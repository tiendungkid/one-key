@extends('layouts.auth')
@section('title', 'Login')
@section('head')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
@endsection
@section('content')
    <div class="ok-app">
        <div class="ok-left">
            <img src="{{asset('images/avatars/tiendungkid.png')}}" alt="Logo">
            <form action="{{route('login')}}" method="post">
                @csrf
                <h3>Welcome back</h3>
                <label for="email"></label>
                <input placeholder="Your Email" name="email" type="email"
                       id="email" autocomplete="off">
                <label for="password"></label>
                <input placeholder="Password" name="password" type="password"
                       id="password" autocomplete="off">
                <input name="remember" id="remember" type="checkbox"/>
                <label class="cbx" for="remember">
                    <span>
                        <svg width="12px" height="10px">
                          <use xlink:href="#check"></use>
                        </svg>
                    </span>
                    <span>Remember me</span>
                </label>
                <svg class="ok-check-svg">
                    <symbol id="check" viewbox="0 0 12 10">
                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                    </symbol>
                </svg>
                <button type="button">Sign in</button>
            </form>
        </div>
        <div class="ok-right">
            <h1>
                <span>OneKey Manager</span>
            </h1>
        </div>
    </div>
@endsection
