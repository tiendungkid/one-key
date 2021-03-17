@extends('layouts.management')
@section('title', 'Edit profile')
@section('style')
    <link rel="stylesheet" href="{{asset('vendors/css/lightbox.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/management/croppie.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugin/spinner.css')}}">
    <link rel="stylesheet" href="{{asset('css/management/edit-profile.css')}}">
@endsection
@section('content')
    <div class="header bg-info pb-4">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center pt-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">
                            <i class="fal fa-user-edit"></i>
                            Edit Profile
                        </h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item">
                                    <a href="{{route('management')}}">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('profile')}}">Profile</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header pb-6 d-flex align-items-center"
         id="big-backdrop"
         style="min-height: 500px; background-image: url({{ file_exists(public_path('images/backdrops/'.auth()->user()->name.'.png')) ? asset('images/backdrops/'.auth()->user()->name.'.png') : asset('images/backdrops/default.jpg')}}); background-size: cover; background-position: center;">
        <span class="mask bg-gradient-default opacity-7"></span>
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">{{'@'.ucfirst(auth()->user()->name)}}</h1>
                    <p class="text-white mt-0 mb-5 animate__animated animate__fadeInDown animate__delay-2s">{{auth()->user()->bio}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--8">
        <div class="row">
            <div class="col-xl-4 order-xl-2">
                <div class="card card-profile">
                    <a href="{{ file_exists(public_path('images/backdrops/'.auth()->user()->name.'.png')) ? asset('images/backdrops/'.auth()->user()->name.'.png') : asset('images/backdrops/default.jpg')}}"
                       data-lightbox="backdrop"
                       id="backdrop-light-box"
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
                                   id="avatar-light-box"
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
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <label for="input-avatar" class="btn btn-sm btn-info mr-4">
                                <input type="file" name="avatar" id="input-avatar"
                                       accept="image/x-png,image/jpeg"
                                       class="input-avatar"/>
                                <i class="fal fa-upload"></i>
                                AV
                            </label>
                            <label for="input-backdrop" class="btn btn-sm btn-success float-right">
                                <input type="file" name="backdrop" id="input-backdrop"
                                       accept="image/x-png,image/jpeg"
                                       class="input-backdrop"/>
                                <i class="fal fa-upload"></i>
                                BG
                            </label>
                        </div>
                    </div>
                    <div class="card-body pt-3">
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
            <div class="col-xl-8 order-xl-1 animate__animated animate__pulse">
                <form method="post" action="{{route('update-user')}}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Edit profile </h3>
                                </div>
                                <div class="col-4 text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">User information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="name">Username</label>
                                            <input type="text" id="name" class="form-control"
                                                   placeholder="Username" value="{{auth()->user()->name}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">Email address</label>
                                            <input type="email" id="email"
                                                   value="{{auth()->user()->email}}"
                                                   class="form-control"
                                                   placeholder="example@email.com" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="full_name">Full name</label>
                                            <input type="text" id="full_name"
                                                   class="form-control @error('full_name') is-invalid @enderror"
                                                   name="full_name"
                                                   placeholder="Full name" value="{{auth()->user()->full_name}}">
                                            @error('full_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="date">Date</label>
                                            <input type="text" id="date"
                                                   class="form-control datepicker @error('date') is-invalid @enderror"
                                                   name="date"
                                                   placeholder="Date"
                                                   value="{{auth()->user()->date->format('Y-m-d')}}">
                                            @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="select-gender" class="form-control-label">Gender</label>
                                            <select
                                                class="custom-select @error('gender') is-invalid @enderror"
                                                id="select-gender" name="gender">
                                                <option value="1" @if(auth()->user()->gender) selected @endif>
                                                    Male
                                                </option>
                                                <option value="0" @if(!auth()->user()->gender) selected @endif>
                                                    Female
                                                </option>
                                            </select>
                                            @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">Contact information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="location">Location</label>
                                            <input id="location"
                                                   class="form-control @error('location') is-invalid @enderror"
                                                   placeholder="Your Address"
                                                   name="location"
                                                   value="{{auth()->user()->location}}" type="text">
                                            @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="phone">Phone number</label>
                                            <input type="text" id="phone"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   placeholder="Phone"
                                                   name="phone"
                                                   value="{{auth()->user()->phone}}">
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="form-control-label" for="website">Website</label>
                                            <input type="text" id="website"
                                                   class="form-control @error('website') is-invalid @enderror"
                                                   name="website"
                                                   placeholder="Website" value="{{auth()->user()->website}}">
                                            @error('website')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <!-- Description -->
                            <h6 class="heading-small text-muted mb-4">About me</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="job" class="form-control-label">Job</label>
                                            <input type="text"
                                                   class="form-control @error('job') is-invalid @enderror"
                                                   id="job" name="job"
                                                   value="{{auth()->user()->job}}">
                                            @error('job')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="company" class="form-control-label">Company</label>
                                            <input type="text"
                                                   class="form-control @error('company') is-invalid @enderror"
                                                   id="company" name="company"
                                                   value="{{auth()->user()->company}}">
                                            @error('company')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Description</label>
                                    <textarea rows="4"
                                              class="form-control @error('bio') is-invalid @enderror"
                                              placeholder="Your discriptions"
                                              name="bio"
                                              id="description">{{auth()->user()->bio}}</textarea>
                                    @error('bio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal change avatar -->
    <div class="modal fade animate__animated animate__slideInDown"
         tabindex="-1" role="dialog"
         id="avatar-modal"
         data-backdrop="static"
         aria-labelledby="upload-avatar"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title text-white">Crop</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="avatar-image-container" class="d-block m-auto"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="upload-avatar-button">
                        Upload
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal change backdrop -->
    <div class="modal fade animate__animated animate__slideInDown"
         tabindex="-1" role="dialog"
         id="backdrop-modal"
         data-backdrop="static"
         aria-labelledby="upload-backdrop"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title text-white">Crop</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="backdrop-image-container" class="d-block m-auto"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="upload-backdrop-button">
                        Upload
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('library-script')
    <script src="{{asset('vendors/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('vendors/js/lightbox.min.js')}}"></script>
    <script src="{{asset('js/management/croppie.js')}}"></script>
@endsection
@section('script')
    <script src="{{asset('js/management/edit-profile.js')}}"></script>
@endsection
