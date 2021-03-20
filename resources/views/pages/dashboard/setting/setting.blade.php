@extends('layouts.app')
@section('title', 'Setting')
@section('style')
@endsection
@section('content')
    <div class="header bg-info pb-4 h-auto">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('profile')}}">Profile</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-lg-10">

                <div class="card border border-info">
                    <div class="card-header bg-transparent">
                        <h3>
                            <i class="fab fa-chrome"></i>
                            Chrome extension integration
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="access_token">Access token</label>
                            <div class="input-group date">
                                <input type="text" class="form-control border-default" name="access_token"
                                       id="access_token"
                                       value="{{ isset($access_token) ? $access_token : null }}" disabled>
                                <span class="input-group-addon input-group-append">
                                    <button class="btn btn-outline-darker" type="button" id="button-addon2">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </span>
                            </div>
                            <form action="{{ route('users.refresh-access-token') }}" method="post" class="mt-3">
                                @csrf
                                <button class="btn btn-outline-default">Generate | Refresh</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border border-danger">
                    <div class="card-header bg-transparent">
                        <h3>Danger zone</h3>
                    </div>
                    <div class="card-body">
                        <h5>
                            <strong class="text-danger">Warning !</strong>
                        </h5>
                        <p class="text-muted">All of the actions below are of great importance, please review before
                            proceeding. We
                            will not be responsible for any of your uncertainties.</p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h5>Delete all service</h5>
                                <p>
                                    <small>We will delete all your services. Please note this means we will also delete
                                        <span class="text-warning">all your accounts for these services</span>
                                    </small>
                                </p>
                                <form action="{{ route('services.truncate') }}" method="post"
                                      onsubmit="return confirm('Are you sure ? A file backup will be download !');">
                                    @csrf
                                    <button class="btn btn-outline-danger btn-sm">Delete all service</button>
                                </form>
                            </li>
                            <li class="list-group-item">
                                <h5>Delete all account</h5>
                                <p>
                                    <small>Note that this will not be recoverable. Please consider carefully before
                                        continuing
                                    </small>
                                </p>
                                <form action="{{ route('accounts.truncate') }}" method="post"
                                      onsubmit="return confirm('Are you sure ? A file backup will be download !');">
                                    @csrf
                                    <button class="btn btn-outline-danger btn-sm">Delete all account</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
