@extends('layouts.app')
@section('title', "New service")
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
                                    <span>New Service</span>
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
                <form action="{{ route('services.store') }}" method="post">
                    @csrf
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                    <label for="home_link" class="mt-3">Home link</label>
                    <input type="text" class="form-control" name="home_link" id="home_link">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                    @endif
                    <button class="btn btn-primary mt-5" type="submit">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
