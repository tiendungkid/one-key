@extends('layouts.app')
@section('title', "({$service->name}) service")
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
                                    <span> {{ $service->name }} Service</span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('services.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $service->id }}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $service->name }}" id="name">
                    <label for="home_link" class="mt-3">Home link</label>
                    <input type="text" class="form-control" name="home_link" value="{{ $service->home_link }}"
                           id="home_link">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                    @endif
                    <button class="btn btn-primary mt-5" type="submit">Save</button>
                    <a href="#" class="btn btn-success mt-5">
                        <i class="fas fa-swatchbook"></i>
                        Account list
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
