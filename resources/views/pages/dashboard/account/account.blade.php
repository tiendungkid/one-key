@extends('layouts.app')
@section('title', 'Accounts')
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
                                    <a href="{{route('accounts')}}">Account</a>
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
            <div class="col-md-4">
                <a href="{{route('accounts.export')}}" target="_blank">
                    <div class="card">
                        <div class="card-body">
                            <i class="fas fa-download text-primary"></i>
                            Export
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{route('accounts.import')}}" target="_blank">
                    <div class="card">
                        <div class="card-body">
                            <i class="fas fa-file-export text-primary"></i>
                            Import
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
