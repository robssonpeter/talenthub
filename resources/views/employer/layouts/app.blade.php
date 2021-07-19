<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') | {{config('app.name')}} </title>
    <link rel="shortcut icon" href="{{ getSettingValue('favicon') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- General CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js" as="script">

@stack('css')

<!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/components.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link href="{{ mix('assets/css/infy-loader.css') }}" rel="stylesheet" type="text/css"/>

</head>
<body class="layout-3">
<div id="app">
    <div class="infy-loader" id="overlay-screen-lock">
        @include('loader')
    </div>
    <div class="main-wrapper container">
    @include('employer.layouts.header')
    @include('employer_profile.edit_profile_modal')
    @include('employer_profile.change_password_modal')

    <!-- Main Content -->
        <div class="main-content">
            <div class="alerts d-none" id="alerts">
                <div :class="'padding-12 alert-'+alerts[currentIndex].type+' d-flex'" v-if="alerts.length">
                    <section v-if="alerts.length > 1">
                        <a href="#previous-message" class="mr-1 rounded-circle" disabled="currentIndex == 0 ? true: false" @click.prevent="changeIndex('previous')"><</a> <span class="mr-1">@{{ currentIndex+1 }}</span> / <span class="ml-1">@{{ alerts.length }}</span> <a href="#next-message" disabled="currentIndex == alert.alerts.length - 1 ? true: false" class="ml-2 mr-3" @click.prevent="changeIndex('next')">></a>
                    </section>
                    <span class="flex-fill"><strong class="text-da">Info:</strong> @{{alerts[currentIndex].message}}</span>
                    <a :href="alertLink(currentIndex)" class="align-self-center btn-sm btn-primary pull-right">@{{alerts[currentIndex].action.name}}</a>

                    <div class="dropdown show pt-1 pl-1" v-if="alerts[currentIndex].dismissible">
                        <a class="dropdown-toggle align-self-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#" @click.prevent="dismissAlert">Dismiss</a>
                        </div>
                    </div>
                </div>
            </div>
            {{--@if(session()->has('message') && \Route::currentRouteName() != 'company.verify')
                @php
                    $alertMessage = session()->get('message');
                @endphp
                @include('alerts.info-alternative')
            @endif--}}
            @yield('content')
        </div>
        <footer class="main-footer">
            @include('layouts.footer')
        </footer>
    </div>
</div>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/web/js/stisla.js') }}"></script>
<script src="{{ asset('assets/web/js/scripts.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script>
    (function ($) {
        $.fn.button = function (action) {
            if (action === 'loading' && this.data('loading-text')) {
                this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
            }
            if (action === 'reset' && this.data('original-text')) {
                this.html(this.data('original-text')).prop('disabled', false);
            }
        };
    }(jQuery));
    $(document).ready(function () {
        $('.alert').delay(5000).slideUp(300);
    });
    $('[data-dismiss=modal]').on('click', function (e) {
        var $t = $(this),
            target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

        $(target).modal("hide");
    });
</script>
@stack('scripts')
<script>
    let alertProcessor = "{{ route('alert.process', '**alert_id**') }}";
    let alertDismissor = "{{ route('alert.dismiss', '**alert_id**') }}";
    let profileUrl = "{{ url('employer/employer-profile') }}";
    let profileUpdateUrl = "{{ url('employer/employer-profile-update') }}";
    let updateLanguageURL = "{{ url('update-language')}}";
    let changePasswordUrl = "{{ url('employer/employer-change-password') }}";
    let loggedInUserId = "{{ getLoggedInUserId() }}";
    let defaultImageUrl = "{{ asset('assets/img/infyom-logo.png') }}";

    $(document).on('click', '.document', function(){
        var link = this.id;
        var doc = document.getElementById('doc');
        //alert(link);
        //doc.data=link;
        doc.innerHTML= "<object data='"+link+"'\n" +
            "                          type='application/pdf'\n" +
            "                          width='100%'\n" +
            "                          height='500px'>\n" +
            "                      <p>This browser does not support inline PDFs. Please download the PDF to view it: <a href=\"http://www.africau.edu/images/default/sample.pdf\">Download PDF</a></p>\n" +
            "                  </object>"
        //documentMode();
    })
</script>
<script src="{{ mix('assets/js/employer_profile/employer_profile.js') }}"></script>
<script src="{{ asset('js/currency.js') }}"></script>
@include('modals.document-modal');
<script>
    alerts = @json(session()->get('message'))

    user_alerts = @json(session()->get('user_alerts'))

    user_alerts.push(alerts);

    console.log(alerts);
    let alert = new Vue({
        el: '#alerts',
        mounted: function(){
            /* this.alerts.push(alerts);
             this.alerts.concat(user_alerts)*/
            this.alerts = user_alerts;
            console.log(user_alerts);
            document.getElementById('alerts').classList.remove('d-none')
           //this.alerts.push(alerts)
        },
        data: {
            alert_processor: alertProcessor,
            greeting: 'hello world',
            currentIndex: 0,
            alerts: [

            ]
        },
        methods: {
            alertLink: function(index){
                if(!this.alerts[index]){
                    return ''
                }
                if(this.alerts[index].user_id) {
                    return this.alert_processor.replace('**alert_id**', this.alerts[index].id);
                }
                return this.alerts[index].action.url
            },
            changeIndex: function(act){
                if(act === 'next' && this.alerts[this.currentIndex+1]){
                    this.currentIndex = this.currentIndex + 1;
                }else if(act === 'previous' && this.currentIndex > 0){
                    this.currentIndex = this.currentIndex - 1;
                }
            },
            dismissAlert: function(){
                let index = this.currentIndex;
                let url = alertDismissor.replace('**alert_id**', this.alerts[index].id);
                let alert_id = this.alerts[this.currentIndex].id;
                let attachedData = {alert_id: alert_id};
                $.post(url, attachedData).done(function (result) {
                    if(result){
                        alert.alerts.splice(alert.currentIndex, 1);
                    }
                })["catch"](function (error) {
                    /*$(_this).html('Purchase').removeClass('disabled');*/
                    /*$('.subscribe').attr('disabled', false);*/displayErrorMessage(error.responseJSON.message);
                });
                /*axios.post(url, {alert_id: alert_id}).then((result) => {
                    if(result.data){
                        this.alerts.splice(this.currentIndex, 1);
                    }
                });*/
            }
        }
    })
</script>
</body>
</html>
