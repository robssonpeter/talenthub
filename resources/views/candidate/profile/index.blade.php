@extends('candidate.layouts.app')
@section('title')
    {{ __('messages.profile') }}
@endsection
@stack('page-css')
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        .flex-wrapper {
            display: flex;
            flex-flow: row nowrap;
        }

        .single-chart {
            width: 33%;
            justify-content: space-around ;
        }

        .circular-chart {
            display: block;
            margin: 10px auto;
            max-width: 80%;
            max-height: 250px;
        }

        .circle-bg {
            fill: none;
            stroke: #eee;
            stroke-width: 3.8;
        }

        .circle {
            fill: none;
            stroke-width: 2.8;
            stroke-linecap: round;
            animation: progress 1s ease-out forwards;
        }

        @keyframes progress {
            0% {
                stroke-dasharray: 0 100;
            }
        }

        .circular-chart.orange .circle {
            stroke: #ff9f00;
        }

        .circular-chart.green .circle {
            stroke: #4CC790;
        }

        .circular-chart.blue .circle {
            stroke: #3c9ee5;
        }

        .percentage {
            fill: #666;
            font-family: sans-serif;
            font-size: 0.5em;
            text-anchor: middle;
        }
    </style>
@endpush
@section('content')
    <section class="section profile">
        <div class="section-header">
            <h1>{{ __('messages.profile') }}</h1>
            <a class="font-weight-bold public-profile"
               href="{{ route('front.candidate.details',$user->candidate->unique_id) }}"
               target="_blank">{{ __('messages.common.view_profile') }}</a>
        </div>
        @include('flash::message')
        <div class="section-body profile-body">
            <div class="card" id="profile-menu">
                @include('layouts.errors')
                <div class="card-body py-0 mt-2">
                    @include('candidate.profile.profile_menu')
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        let companyStateUrl = "{{ route('states-list') }}";
        let companyCityUrl = "{{ route('cities-list') }}";
        let schoolUrl = "{{ route('schools-list') }}";
        let defaultImageUrl = "{{ asset('assets/img/infyom-logo.png') }}";
        $('#circle').circleProgress({
            value: 0.75,
            size: 80,
            fill: {
                gradient: ["blue", "orange"]
            },
            startAngle: -Math.PI / 2,
        });

    </script>
    @stack('page-scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
@endpush
