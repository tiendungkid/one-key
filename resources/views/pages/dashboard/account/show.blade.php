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
                                    <a href="{{ route('accounts.index') }}">Account</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('services.show', $account->service->id) }}">
                                        {{ $account->service->name }}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <span>{{ $account->name }}</span>
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
                        <div class="card-title">
                            <b>{{ $account->name }}</b>
                        </div>
                        @if(session()->has('updated'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-text"><strong>Updated!</strong></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ route('accounts.destroy', $account->id) }}" method="post" id="delete"
                              onsubmit="return confirm('Are you sure you want !')">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="service_id" value="{{ $account->service->id }}">
                        </form>
                        <form action="{{ route('accounts.update', $account->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="service_id" value="{{ $account->service->id }}">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                                       value="{{ $account->name }}">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password"
                                       class="form-control" value="{{ $account->password }}">
                            </div>

                            <div class="form-group">
                                <label for="two_fa_code">2FA Code</label>
                                <input type="text" name="two_fa_code" id="two_fa_code" placeholder="2FA Code"
                                       class="form-control" value="{{ $account->two_fa_code }}">
                            </div>

                            <div class="form-group">
                                <label for="color">Color label</label>
                                <input type="color" name="color" id="color" class="form-control"
                                       value="{{ $account->color }}">
                            </div>

                            <div class="form-group">
                                <label for="attributes"></label>
                                <input type="text" class="form-control" name="attributes" id="attributes"
                                       placeholder="Notes" data-toggle="tags" value="{{ $account->attributes }}"/>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" rows="3"
                                          resize="none">{{ $account->description }}</textarea>
                            </div>

                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                    <p class="text-danger">{{ $error }}</p>
                                @endforeach
                            @endif

                            <button type="submit" class="btn btn-primary" name="id" value="{{ $account->id }}">
                                Update
                            </button>

                            <button type="submit" form="delete" class="btn btn-danger" name="id"
                                    value="{{ $account->id }}">
                                Delete
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
