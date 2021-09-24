@extends('layouts.app')
@section('title', 'Services')
@section('head')
    <meta name="service-datatable" content="{{ route('services.datatable') }}">
    <meta name="service-show" content="{{ route('services.show', 0) }}">
    <meta name="service-account-list" content="{{ route('accounts.list', 0) }}">
    <link rel="stylesheet"
          href="{{ asset('vendors/argon/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('vendors/argon/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('vendors/argon/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
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
                                    <a href="{{route('services.index')}}">Service</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{route('services.create')}}" class="btn btn-sm btn-neutral">
                            New
                        </a>
                        <a href="{{route('services.export')}}" class="btn btn-sm btn-neutral" target="_blank">
                            Export
                        </a>
                        <a href="{{route('services.import')}}" class="btn btn-sm btn-neutral">
                            Import
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="h3 mb-0">Service manager</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-flush dataTable" id="service-table" style="width: 100%">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Home Link</th>
                                    <th>Total account</th>
                                    <th>Created at</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('vendors/argon/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/argon/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/argon/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendors/argon/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/argon/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendors/argon/vendor/moment.min.js') }}"></script>
    <script src="{{ asset('js/app/service/service.js') }}"></script>
@endsection
