@extends('layouts.app')
@section('title', 'Accounts')
@section('style')
    <link rel="stylesheet"
          href="{{ asset('vendors/argon/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}">
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
                                <li class="breadcrumb-item active">
                                    <span>New</span>
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
            <div class="col-md-10 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Create account for (<b>{{ $service->name }}</b>)</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('accounts.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password"
                                       class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="two_fa_code">2FA Code (Optional)</label>
                                <input type="text" name="two_fa_code" id="two_fa_code" placeholder="2FA Code"
                                       class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="color">Color label (Optional)</label>
                                <input type="color" name="color" id="color" class="form-control" value="#7cc7e6">
                            </div>

                            <div class="form-group">
                                <label for="attributes" class="w-100 d-block">Tags (Optional)</label>
                                <input type="text" class="form-control" name="attributes" id="attributes"
                                       placeholder="Notes" data-toggle="tags"/>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="description">Description (Optional)</label>
                                <textarea name="description" class="form-control" id="description" rows="3"
                                          resize="none"></textarea>
                            </div>

                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                    <p class="text-danger">{{ $error }}</p>
                                @endforeach
                            @endif

                            <button type="submit" class="btn btn-primary" name="service_id" value="{{ $service->id }}">
                                Create
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script-plugin')
    <script src="{{ asset('vendors/argon/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
@endsection
