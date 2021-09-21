@extends('layouts.app')
@section('title', 'Dashboard')
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
                                    <a href="{{ route('dashboard') }}">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Services</h5>
                                <span class="h2 font-weight-bold text-success">{{$totalService}}</span>
                            </div>
                            <div class="col-auto">
                                <a href="{{route('services.index')}}"
                                   class="icon icon-shape rounded-circle shadow border">
                                    <i class="fal fa-clouds text-primary"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Accounts</h5>
                                <span class="h2 font-weight-bold text-success">{{$totalAccount}}</span>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('accounts.index') }}"
                                   class="icon icon-shape border rounded-circle shadow">
                                    <i class="fal fa-fog text-cyan"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
