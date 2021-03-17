@extends('layouts.management')
@section('title', 'Setting')
@section('style')
@endsection
@section('content')
    <div class="header bg-danger pb-4">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center pt-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">
                            <i class="fal fa-file-invoice-dollar"></i>
                            Billing
                        </h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item">
                                    <a href="{{route('management')}}">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('payments')}}">Payment</a>
                                </li>
                                <li class="breadcrumb-item active">Billing</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Card -->
@endsection
@section('library-script')
@endsection
@section('script')
@endsection
