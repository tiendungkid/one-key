@extends('layouts.app')
@section('title', 'Import')
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
                                    <a href="{{ route('accounts.index') }}">Account import</a>
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
                <form action="{{ route('accounts.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label" for="file">Select file</label>
                        <input type="file" name="file" class="form-control" id="file" placeholder="Select file"
                               accept=".json">
                    </div>
                    <button class="btn btn-primary float-right" type="submit">
                        Import accounts
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
