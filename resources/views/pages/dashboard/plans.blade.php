@extends('layouts.management')
@section('title', 'Plans')
@section('style')
    <link rel="stylesheet" href="{{asset('css/management/plan.css')}}">
@endsection
@php
    use App\Models\PlanType;
@endphp
@section('content')
    <div class="header bg-info py-4">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center pt-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">
                            <i class="fal fa-list-alt"></i>
                            Plan list
                        </h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item">
                                    <a href="{{route('management')}}">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('plan-detail')}}">Plan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Plan list</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="pricing pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-5 card-lift--hover mb-lg-0 text-dark border border-success">
                        <div class="card-body">
                            <h5 class="card-title text-uppercase text-center">Free</h5>
                            <h6 class="card-price text-center">$0<span class="period">/month</span></h6>
                            <hr>
                            <ul class="fa-ul">
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    Max <span
                                        class="font-weight-bold text-warning">{{config('pricing.pricing.plan.free.max_service')}}</span>
                                    services
                                </li>
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    Max <span
                                        class="font-weight-bold text-warning">{{config('pricing.pricing.plan.free.max_account')}}</span>
                                    accounts
                                </li>
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    Support staff
                                </li>
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    Fast generate
                                </li>
                                <li class="text-muted">
                                    <span class="fa-li"><i class="fas fa-times"></i></span>
                                    API caller
                                </li>
                                <li class="text-muted">
                                    <span class="fa-li"><i class="fas fa-times"></i></span>
                                    Follow activity
                                </li>
                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>
                                    Scan and protect
                                </li>
                                <li class="text-muted">
                                    <span class="fa-li"><i class="fas fa-times"></i></span>
                                    Backup data
                                </li>
                            </ul>
                            @if(auth()->user()->group === 10)
                                <button class="btn btn-block btn-dark border-white text-uppercase">Using</button>
                            @else
                                <form action="{{route('upgrade-plan')}}" method="post">
                                    @csrf
                                    <button type="submit"
                                            name="plan"
                                            value="user_free"
                                            class="btn btn-block btn-primary text-uppercase">
                                        Use
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-5 mb-lg-0 card-lift--hover text-dark border border-info">
                        <div class="card-body">
                            <h5 class="card-title text-uppercase text-center">Plus</h5>
                            <h6 class="card-price text-center">${{config('pricing.pricing.plan.plus.price')}}
                                <span class="period">/month</span>
                            </h6>
                            <hr>
                            <ul class="fa-ul">
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    Max <span
                                        class="font-weight-bold text-warning">{{config('pricing.pricing.plan.plus.max_service')}}</span>
                                    services
                                </li>
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    Max <span
                                        class="font-weight-bold text-warning">{{config('pricing.pricing.plan.plus.max_account')}}</span>
                                    accounts
                                </li>
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    Support staff
                                </li>
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    Fast generate
                                </li>
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    API caller
                                </li>
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    Follow activity
                                </li>
                                <li class="text-muted">
                                    <span class="fa-li"><i class="fas fa-times"></i></span>
                                    Scan and protect
                                </li>
                                <li class="text-muted">
                                    <span class="fa-li"><i class="fas fa-times"></i></span>
                                    Backup data
                                </li>
                            </ul>
                            @if(auth()->user()->group === 9)
                                <button class="btn btn-block border-white btn-dark text-uppercase">Using</button>
                            @else
                                <form action="{{route('upgrade-plan')}}" method="post">
                                    @csrf
                                    <button type="submit"
                                            name="plan"
                                            value="user_plus"
                                            class="btn btn-block btn-primary text-uppercase">
                                        Buy
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card card-lift--hover text-dark border border-warning">
                        <div class="card-body">
                            <h5 class="card-title text-uppercase text-center">Pro</h5>
                            <h6 class="card-price text-center">${{config('pricing.pricing.plan.pro.price')}}<span
                                    class="period">/month</span></h6>
                            <hr>
                            <ul class="fa-ul">
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    <span class="font-weight-bold">Unlimited services</span>
                                </li>
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    <span class="font-weight-bold">Unlimited accounts</span>
                                </li>
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    Support staff
                                </li>
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    Fast generate
                                </li>
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    API caller
                                </li>
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    Follow activity
                                </li>
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    Scan and protect
                                </li>
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span>
                                    Backup data
                                </li>
                            </ul>
                            @if(auth()->user()->group === 8)
                                <button class="btn btn-block border-white btn-dark text-uppercase">Using</button>
                            @else
                                <form action="{{route('upgrade-plan')}}" method="post">
                                    @csrf
                                    <button type="submit"
                                            name="plan"
                                            value="user_pro"
                                            class="btn btn-block btn-primary text-uppercase">
                                        Buy
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
@endsection
