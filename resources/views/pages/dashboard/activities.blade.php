@extends('layouts.management')
@section('title', 'Setting')
@section('style')
@endsection
@php
    use Carbon\Carbon;
@endphp
@section('content')
    <div class="header bg-info pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center pt-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">
                            <i class="fas fa-file-signature"></i>
                            Activity
                        </h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item">
                                    <a href="{{route('management')}}">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('activities')}}">Activity</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Activities</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0 text-white">Your activities</h3>
                    </div>
                    <div class="card-body">
                        <div class="timeline timeline-one-side"
                             data-timeline-content="axis"
                             data-timeline-axis-style="dashed">
                            @foreach($activities as $activity)
                                <div class="timeline-block">
                                    <span class="timeline-step badge-neutral">
                                        @switch($activity->activity_type)
                                            @case(1)
                                            <i class="far fa-cog text-danger"></i>
                                            @break
                                            @case(2)
                                            <i class="fad fa-shield text-warning"></i>
                                            @break
                                            @case(3)
                                            <i class="fas fa-usd-circle text-success"></i>
                                            @break
                                            @case(4)
                                            <i class="fal fa-box-open text-pink"></i>
                                            @break
                                            @case(5)
                                            <i class="far fa-question-circle text-warning"></i>
                                            @break
                                        @endswitch
                                    </span>
                                    <div class="timeline-content">
                                        <small class="text-light text-sm mt-1 mb-0 font-weight-bold">
                                            {{$activity->created_at ? $activity->created_at->diffForHumans() : 'Long time ago'}}
                                        </small>
                                        <h5 class="text-white mt-3 mb-0">{{ucfirst($activity->activityType->name)}} -
                                            Notification
                                        </h5>
                                        <p class="text-light text-sm mt-1 mb-0">
                                            {{$activity->message}}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
