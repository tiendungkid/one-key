@extends('layouts.management')
@section('title', 'My Plan')
@section('style')
@endsection
@php
    use Carbon\Carbon;
@endphp
@section('content')
    <div class="header bg-danger pb-4">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center pt-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">
                            <i class="fal fa-receipt"></i>
                            Plan Detail
                        </h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item">
                                    <a href="{{route('management')}}">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('plan-detail')}}">Plan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Plan detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row py-5 justify-content-center">
            <div class="col-xl-8">
                <div class="card border border-success">
                    <div class="card-header">
                        <h5 class="h3 mb-0">
                            @if(in_array(auth()->user()->groupUser->id, [1,2,3]))
                                <span class="text-warning">
                                    {{auth()->user()->groupUser->name}}
                                </span>
                            @else
                                <span class="text-success">
                                    {{auth()->user()->groupUser->name}}
                                </span>
                            @endif
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Amount</strong>
                                <span
                                    class="badge badge-success badge-pill">$ {{$plan->plan_amount}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Max service</strong>
                                <span class="badge badge-primary badge-pill">
                                    @if($plan->plan_detail['max_service'] === 0)
                                        <span class="text-warning">Unlimited</span>
                                    @else
                                        {{$plan->plan_detail['max_service']}}
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Max account</strong>
                                <span class="badge badge-primary badge-pill">
                                    @if($plan->plan_detail['max_account'] === 0)
                                        <span class="text-warning">Unlimited</span>
                                    @else
                                        {{$plan->plan_detail['max_account']}}
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Charge date</strong>
                                <span class="badge badge-primary badge-pill">
                                    @if(in_array(auth()->user()->group, [8,9]))
                                        {{Carbon::parse(auth()->user()->start_plan_date)->format('Y/m/d')}}
                                    @else
                                        <i class="fas fa-minus text-warning"></i>
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Expiration date</strong>
                                <span class="badge badge-primary badge-pill">
                                    @if(in_array(auth()->user()->group, [8,9]))
                                        {{Carbon::parse(auth()->user()->end_plan_date)->format('Y/m/d')}}
                                    @else
                                        <i class="fas fa-minus text-warning"></i>
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Default payment method</strong>
                                <a href="{{route('payments')}}" class="badge badge-primary badge-pill">
                                    {{$plan->default_payment ?: null}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
@endsection
