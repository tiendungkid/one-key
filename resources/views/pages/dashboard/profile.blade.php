@extends('layouts.management')
@section('title', 'Profile')
@section('style')
    <link rel="stylesheet" href="{{asset('vendors/css/lightbox.min.css')}}">
@endsection
@section('content')
    <div class="header bg-info pb-4">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center pt-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">
                            <i class="fal fa-user"></i>
                            Profile
                        </h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item">
                                    <a href="{{route('management')}}">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('profile')}}">Profile</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header pb-6 d-flex align-items-center"
         style="min-height: 500px; background-image: url({{ file_exists(public_path('images/backdrops/'.auth()->user()->name.'.png')) ? asset('images/backdrops/'.auth()->user()->name.'.png') : asset('images/backdrops/default.jpg')}}); background-size: cover; background-position: center;">
        <span class="mask bg-gradient-default opacity-7"></span>
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">{{'@'.ucfirst(auth()->user()->name)}}</h1>
                    <p class="text-white mt-0 mb-5 animate__animated animate__fadeInDown animate__delay-2s">{{auth()->user()->bio}}</p>
                    <a href="{{route('edit-profile-view')}}" class="btn btn-neutral mt-2">
                        <i class="fal fa-user-edit"></i>
                        Edit profile
                    </a>
                    <a href="{{route('setting')}}" class="btn btn-danger mt-2">
                        <i class="fal fa-cog"></i>
                        Setting
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--8">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card card-profile shadow">
                    <a href="{{ file_exists(public_path('images/backdrops/'.auth()->user()->name.'.png')) ? asset('images/backdrops/'.auth()->user()->name.'.png') : asset('images/backdrops/default.jpg')}}"
                       data-lightbox="backdrop"
                       data-title="{{auth()->user()->bio}}"
                       data-alt="{{auth()->user()->name}}">
                        <img
                            src="{{ file_exists(public_path('images/backdrops/'.auth()->user()->name.'.png')) ? asset('images/backdrops/'.auth()->user()->name.'.png') : asset('images/backdrops/default.jpg')}}"
                            alt="Image placeholder"
                            id="user-backdrop"
                            class="card-img-top">
                    </a>
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="{{ file_exists(public_path('images/avatars/'.auth()->user()->name.'.png')) ? asset('images/avatars/'.auth()->user()->name.'.png') : asset('images/avatars/default.png')}}"
                                   data-lightbox="avatar"
                                   data-title="{{auth()->user()->bio}}"
                                   data-alt="{{auth()->user()->name}}">
                                    <img
                                        src="{{ file_exists(public_path('images/avatars/'.auth()->user()->name.'.png')) ? asset('images/avatars/'.auth()->user()->name.'.png') : asset('images/avatars/default.png')}}"
                                        class="rounded-circle"
                                        alt="avatar" id="user-avatar">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-7">
                        <div class="text-center">
                            <h5 class="h3">
                                {{auth()->user()->full_name}}
                            </h5>
                            <div class="h5 font-weight-300">
                                {{auth()->user()->location}}
                            </div>
                            <div class="h5 mt-4">
                                {{auth()->user()->job}}
                                <p class="text-muted">{{auth()->user()->company}}</p>
                            </div>
                            <div class="mt-3">
                                <p>
                                    <i class="fal fa-envelope"></i>
                                    <a href="mailto:{{auth()->user()->email}}">
                                        {{auth()->user()->email}}
                                    </a>
                                </p>
                                @if(auth()->user()->phone)
                                    <p>
                                        <i class="fas fa-mobile-alt"></i>
                                        <a href="callto:{{auth()->user()->phone}}">
                                            {{auth()->user()->phone}}
                                        </a>
                                    </p>
                                @endif
                                @if(auth()->user()->website)
                                    <p>
                                        <i class="fal fa-link"></i>
                                        <a href="//{{isset(parse_url(auth()->user()->website)['host']) ? parse_url(auth()->user()->website)['host'] : auth()->user()->website}}"
                                           target="_blank">
                                            {{auth()->user()->website}}
                                        </a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('vendors/js/lightbox.min.js')}}"></script>
@endsection
