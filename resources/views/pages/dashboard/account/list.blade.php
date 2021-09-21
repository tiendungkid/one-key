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
                                    <a href="{{route('services.index')}}">Services</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('services.show', $service->id)}}">
                                        {{ $service->name }}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span>Accounts</span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            @foreach($accounts as $account)
                <div class="col-md-4">
                    <a href="{{ route('accounts.show', $account->id) }}">
                        <div class="card border" style="border-color: {{ $account->color }} !important;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5>Account</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-muted mb-0">
                                            {{ $account->name }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{ $accounts->links() }}
            </div>
        </div>
    </div>
@endsection
