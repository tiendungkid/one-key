@extends('layouts.app')
@section('title', 'Services')
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
                                    <a href="{{route('services')}}">Service</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="ml-auto">
                        <a href="{{route('services.export')}}" class="btn btn-sm btn-neutral" target="_blank">
                            Export
                        </a>
                    </div>
                    <div class="mx-3">
                        <a href="{{route('services.import')}}" class="btn btn-sm btn-neutral">
                            Import
                        </a>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-2">
                        <form action="{{ route('services.search') }}" method="get">
                            <label class="w-100">
                                <input type="search" name="query" placeholder="Type to search"
                                       class="form-control form-control-sm"
                                       value="{{ isset($query) ? $query : null }}">
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            @foreach($services as $service)
                <div class="col-md-4">
                    <a href="{{ route('services.detail', ['id' => $service->id ]) }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">
                                            {{ $service->name }}
                                            <span>( {{ $service->accounts_count }} )</span>
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
                {{ $services->links() }}
            </div>
        </div>
    </div>
@endsection
