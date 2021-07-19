@extends('layouts.app')
@section('title')
    {{ __('messages.setting.front_settings') }}
@endsection
@section('content')
    <link rel="stylesheet" href="{{asset('assets/css/colorPick.css')}}">
{{--    <link rel="stylesheet" href="{{asset('assets/css/colorPick.dark.theme.css')}}">--}}
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.setting.front_settings') }}</h1>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body">

                    {{ Form::open(['route' => 'front.settings.update']) }}

                    @include('front_settings.fields')

                    {{ Form::close() }}

                </div>
            </div>
        </div>

    </section>
    <script src="{{asset('assets/js/colorPick.js')}}"></script>
    <script>
        $(".colorPickSelector").colorPick({
            'initialColor':'{{isset($frontSettings['slogan_color'])?$frontSettings['slogan_color']:'#FFFFFF'}}',
            'allowRecent':true,
            'recentMax': 5,
            'allowCustomColor':false,
            'palette': ["#fe9004", "#0f2944", "#FFFFFF", "#3498db", "#783d00", "#1abc9c","#16a085","#2ecc71","#27ae60","#3498db","#2980b9","#9b59b6","#8e44ad","#34495e","#2c3e50","#f1c40f","#f39c12","#e67e22","#d35400","#e74c3c","#c0392b","#ecf0f1","#bdc3c7","#95a5a6","#7f8c8d"],
            'onColorSelected':function() {
                $('#color').val(this.color);
                this.element.css({'backgroundColor':this.color,'color':this.color});
            }
        });
    </script>

@endsection

