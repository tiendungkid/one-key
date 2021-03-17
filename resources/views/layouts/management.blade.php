<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Dashboard') | One Key </title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token"
          content="{{csrf_token()}}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet"
          href="{{asset('vendors/profile/assets/vendor/nucleo/css/nucleo.css')}}">
    <link rel="stylesheet"
          href="{{asset('vendors/profile/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('vendors/css/all.css')}}">
    <link rel="stylesheet"
          href="{{asset('vendors/profile/assets/css/argon.css?v=1.2.0')}}">
    <link rel="stylesheet"
          href="{{asset('vendors/animate.css/animate.min.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/management/ok-animation.css')}}">
    <link rel="stylesheet" href="{{asset('css/management/management.css')}}">
    @yield('style')
</head>

<body>
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-info" id="sidenav-main">
    <div class="scrollbar-inner">
        <div class="sidenav-header d-flex align-items-center">
            <div class="ml-auto">
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{Route::currentRouteName() == "dashboard" ? 'active' : null}}"
                           href="{{route('dashboard')}}">
                            <i class="fal fa-tachometer-fast"></i>
                            <span class="nav-link-text">Dashboards</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Route::currentRouteName() == "profile" ? 'active' : null}}"
                           href="{{route('profile')}}">
                            <i class="fal fa-user"></i>
                            <span class="nav-link-text">
                                Profile
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('service')}}"
                           class="nav-link {{Route::currentRouteName() == "service" ? 'active' : null}}">
                            <i class="fal fa-clouds"></i>
                            <span class="nav-link-text">Services</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('account')}}"
                           class="nav-link {{Route::currentRouteName() == "account" ? 'active' : null}}">
                            <i class="fal fa-fog"></i>
                            <span class="nav-link-text">Accounts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('setting')}}"
                           class="nav-link {{Route::currentRouteName() == "setting" ? 'active' : null}}">
                            <i class="fal fa-clouds"></i>
                            <span class="nav-link-text">Setting</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="main-content" id="panel">
    <div class="ok-progress">
        <div class="indeterminate"></div>
    </div>
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-info border-bottom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                    <div class="form-group mb-0">
                        <div class="input-group input-group-alternative input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <label for="dashboard-search"></label>
                            <input class="form-control" placeholder="Search" type="text" id="dashboard-search">
                        </div>
                    </div>
                    <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </form>
                <ul class="navbar-nav align-items-center  ml-md-auto ">
                    <li class="nav-item d-xl-none">
                        <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                             data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item d-sm-none">
                        <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                            <i class="ni ni-zoom-split-in"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('management')}}" class="nav-link">
                            <i class="fal fa-home-lg-alt"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            @if($errors->any() || collect(session()->get("_flash")['new'])->count() > 0)
                                <i class="fas fa-bell-exclamation text-danger animate__animated animate__swing animate__repeat-3"></i>
                            @else
                                <i class="fal fa-bell"></i>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right  py-0 overflow-hidden">
                            <div class="px-3 py-3">
                                <h6 class="text-sm text-muted m-0">
                                    You have
                                    <strong class="text-danger">
                                        {{$errors->count()}} error
                                    </strong> |
                                    <strong class="text-primary">
                                        {{collect(session()->get("_flash")['new'])->count()}} message
                                    </strong>
                                    notifications.
                                </h6>
                            </div>
                            <div class="list-group list-group-flush">
                                @if($errors->any() || collect(session()->get("_flash")['new'])->count() > 0)
                                    @foreach($errors->all() as $error)
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img alt="Image placeholder"
                                                         src="{{asset('images/avatars/tiendungkid.png')}}"
                                                         class="avatar rounded-circle">
                                                </div>
                                                <div class="col ml--2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h4 class="mb-0 text-sm">Admin</h4>
                                                        </div>
                                                        <div class="text-right text-muted">
                                                            <small>just now</small>
                                                        </div>
                                                    </div>
                                                    <p class="text-sm mb-0 text-danger">
                                                        <i class="fal fa-exclamation-circle text-danger"></i>
                                                        {{$error}}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                    @foreach(collect(session()->get("_flash")['new'])->all() as $flashMsg)
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img alt="Image placeholder"
                                                         src="{{asset('images/avatars/tiendungkid.png')}}"
                                                         class="avatar rounded-circle">
                                                </div>
                                                <div class="col ml--2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h4 class="mb-0 text-sm">Admin</h4>
                                                        </div>
                                                        <div class="text-right text-muted">
                                                            <small>just now</small>
                                                        </div>
                                                    </div>
                                                    <p class="text-sm mb-0 text-primary">
                                                        {{session()->get($flashMsg)['message']}}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                            <a href="#" class="dropdown-item text-center text-primary font-weight-bold py-3">
                                View all
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <i class="ni ni-ungroup"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default  dropdown-menu-right ">
                            <div class="row shortcuts px-4">
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <div class="media align-items-center">
                                  <span class="avatar avatar-sm rounded-circle">
                                      <img alt="Image placeholder"
                                           src="{{file_exists(public_path('images/avatars/'.auth()->user()->name.'.png')) ? asset('images/avatars/'.auth()->user()->name.'.png') : asset('images/avatars/default.png')}}">
                                  </span>
                                <div class="media-body  ml-2  d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">
                                        {{ucfirst(auth()->user()->name)}}
                                    </span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right ">
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>
                            <a href="{{route('profile')}}" class="dropdown-item">
                                <i class="ni ni-single-02"></i>
                                <span>My profile</span>
                            </a>
                            <a href="{{route('setting')}}" class="dropdown-item">
                                <i class="ni ni-settings-gear-65"></i>
                                <span>Settings</span>
                            </a>
                            <a href="#support-modal" class="dropdown-item" data-toggle="modal"
                               data-target="#support-modal">
                                <i class="ni ni-support-16"></i>
                                <span>Support</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('lock')}}" class="dropdown-item">
                                <i class="fal fa-lock-alt"></i>
                                <span>Lock</span>
                            </a>
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button href="{{route('logout')}}" type="submit" class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <span>Sign out</span>
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    @yield('content')
</div>
<!-- Support modal -->
<div class="modal fade animate__animated animate__pulse bg-gradient-dark"
     tabindex="-1" role="dialog"
     id="support-modal"
     aria-labelledby="support-modal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Support</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="support-user-email" class="form-control-label">Email</label>
                    <input type="email" class="form-control" name="support-user-email" id="support-user-email"
                           value="{{auth()->user()->email}}" disabled>
                </div>
                <div class="form-group">
                    <label for="support-user-name" class="form-control-name">Your name</label>
                    <input type="text" class="form-control" name="support-user-name" id="support-user-name"
                           value="{{auth()->user()->full_name}}">
                </div>
                <div class="form-group">
                    <label for="support-user-issue" class="form-control-label">Issue</label>
                    <textarea rows="4" class="form-control"
                              name="support-user-issue" id="support-user-issue"
                              placeholder="Enter your issue..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">
                    <i class="far fa-paper-plane"></i>
                    Send
                </button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{asset('vendors/profile/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('vendors/profile/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendors/profile/assets/vendor/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('vendors/profile/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('vendors/profile/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
<script src="{{asset('vendors/profile/assets/vendor/chart.js/dist/Chart.min.js')}}"></script>
<script src="{{asset('vendors/profile/assets/vendor/chart.js/dist/Chart.extension.js')}}"></script>
<script src="{{asset('vendors/js/bootstrap-notify.min.js')}}"></script>
@yield('library-script')
<script src="{{asset('vendors/profile/assets/js/argon.js')}}"></script>
<script src="{{asset('js/management/management.js')}}"></script>
@yield('script')
</html>
