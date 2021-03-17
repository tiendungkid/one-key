<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Lock screen | One Key</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet"
          href="{{asset('vendors/profile/assets/vendor/nucleo/css/nucleo.css')}}">
    <link rel="stylesheet"
          href="{{asset('vendors/css/all.css')}}">
    <link rel="stylesheet"
          href="{{asset('vendors/profile/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('vendors/css/lightbox.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('vendors/css/animate.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('vendors/profile/assets/css/argon.css?v=1.2.0')}}">
    <link rel="stylesheet"
          href="{{asset('css/management/management.css')}}">
    <link rel="stylesheet" href="{{asset('css/lock.css')}}">
    <script src="{{asset('vendors/js/jquery.js')}}"></script>
    <script src="{{asset('vendors/js/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('js/auht/lock.js')}}"></script>
</head>

<body class="bg-lock"
      style="min-height: 500px; background-image: url({{ file_exists(public_path('images/backdrops/'.auth()->user()->name.'.png')) ? asset('images/backdrops/'.auth()->user()->name.'.png') : asset('images/backdrops/default.jpg')}}); background-size: cover; background-position: center;">
@if(session('error'))
    <script>notifyErrorCode()</script>
@endif
<div class="main-content h-auto">
    <div class="container mt-8">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card mt-5">
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
                    <div class="card-body pt-7 px-5 bg-white">
                        <div class="text-center mb-4">
                            <h3>{{auth()->user()->full_name}}</h3>
                        </div>
                        <form role="form" action="{{route('unlock')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <label for="password"></label>
                                    <input class="form-control @if(isset($error)) is-invalid @endif"
                                           autocomplete="password"
                                           name="password" placeholder="Lock code OR password"
                                           type="password"
                                           id="password">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-2">
                                    Unlock
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="container">
        <div class="row justify-content-center text-center">
            {{--            <div class="col-auto pb-2">--}}
            {{--                <a href="{{route('password.request')}}" class="btn btn-primary">--}}
            {{--                    <i class="fas fa-question"></i>--}}
            {{--                    Forget password--}}
            {{--                </a>--}}
            {{--            </div>--}}
            {{--            <div class="col-auto pb-2">--}}
            {{--                <form action="{{route('logout')}}" method="post">--}}
            {{--                    @csrf--}}
            {{--                    <button type="submit" class="btn btn-danger">--}}
            {{--                        <i class="fal fa-sign-out-alt"></i>--}}
            {{--                        Sign out--}}
            {{--                    </button>--}}
            {{--                </form>--}}
            {{--            </div>--}}
            {{--            <div class="col-auto pb-2">--}}
            {{--                <button class="btn btn-success"--}}
            {{--                        data-toggle="modal"--}}
            {{--                        data-target="#support-modal">--}}
            {{--                    <i class="fal fa-question-circle"></i>--}}
            {{--                    Get support--}}
            {{--                </button>--}}
            {{--            </div>--}}
        </div>
    </div>
</footer>
<!-- Support modal -->
<div class="modal fade animate__pulse animate__animated bg-gradient-dark"
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
<script src="{{asset('vendors/profile/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('vendors/profile/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendors/profile/assets/vendor/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('vendors/profile/assets/js/argon.js')}}"></script>
<script src="{{asset('vendors/js/lightbox.min.js')}}"></script>
</body>

</html>
