@extends('web.layouts.app')
@section('title')
    {{ __('web.register') }}
@endsection
@section('content')
    <!-- =============== Start of Page Header 1 Section =============== -->
    <section class="page-header">
        <div class="container">
            <!-- Start of Page Title -->
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ __('web.register') }}</h2>
                </div>
            </div>
            <!-- End of Page Title -->
        </div>
    </section>
    <!-- =============== End of Page Header 1 Section =============== -->

    <!-- ===== Start of Login - Register Section ===== -->
    <section class="ptb80" id="register">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <!-- Start of Nav Tabs -->
                    <ul class="nav nav-tabs" role="tablist">

                        <!-- Candidate Tab -->
                        <li role="presentation" class="active">
                            <a href="#candidate" id="candidate-tab" aria-controls="candidate" role="tab" data-toggle="tab"
                               aria-expanded="true">
                                <h6>{{ __('web.register_menu.candidate') }}</h6>
                            </a>
                        </li>

                        <!-- Employer Tab -->
                        <li role="presentation" class="">
                            <a href="#employer" id="employer-tab" aria-controls="employer" role="tab" data-toggle="tab"
                               aria-expanded="false">
                                <h6>{{ __('web.register_menu.employer') }}</h6>
                            </a>
                        </li>
                    </ul>
                    <!-- End of Nav Tabs -->

                    <!-- Start of Tab Content -->
                    <div class="tab-content ptb60">
                        <!-- Start of Tabpanel for Candidate Account -->
                        <div role="tabpanel" class="tab-pane active" id="candidate">

                            {{ Form::open(['id'=>'addCandidateNewForm']) }}
                            {{--<form action="{{route('front.save.register')}}" method="POST">
                                @csrf--}}
                            <input type="hidden" name="type" value="1">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="form-group">
                                        <label>{{ __('web.common.first_name').":" }}<span
                                                    class="required asterisk-size">*</span> </label>
                                        <input type="text" name="first_name" id="candidateFirstName"
                                               class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('web.common.last_name').":" }}</label>
                                        <input type="text" name="last_name" id="candidateLastName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('web.common.email').":" }} <span
                                                    class="required asterisk-size">*</span></label>
                                        <input type="email" name="email" id="candidateEmail" class="form-control"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('web.common.password').":" }} <span
                                                    class="required asterisk-size">*</span></label>
                                        <input type="password" name="password" id="candidatePassword"
                                               class="form-control" required>
                                    </div>
                                    <div class="form-group mb30">
                                        <label>{{ __('web.common.confirm_password').":" }}<span
                                                    class="required asterisk-size">*</span></label>
                                        <input type="password" name="password_confirmation"
                                               id="candidateConfirmPassword" class="form-control" required>
                                    </div>
                                    <div class="form-check mb30">
                                        <input required class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            I accept the <a href="{{route('terms.conditions')}}" class="text-purple" target="_blank">terms and conditions</a>
                                        </label>
                                    </div>
                                    <div class="form-group text-center nomargin">
                                        <button type="submit" class="btn bg-purple form-control" id="btnCandidateSave"
                                                data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">
                                            {{ __('web.register_menu.create_account') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </form>
                            {{ Form::close() }}
                        </div>
                        <!-- End of Tabpanel for Candidate Account -->

                        <!-- Start of Tabpanel for Employer Account -->
                        <div role="tabpanel" class="tab-pane" id="employer">
                            {{ Form::open(['id'=>'addEmployerNewForm']) }}
                            {{--<form action="{{route('front.save.register')}}" method="POST">
                                @csrf--}}
                            <input type="hidden" name="type" value="2">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="form-group">
                                        <label>{{ __('messages.company.company_name').":" }} <span
                                                    class="required asterisk-size">*</span></label>
                                        <input type="text" name="first_name" id="employerFirstName" class="form-control"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('web.common.email').":" }} <span
                                                    class="required asterisk-size">*</span></label>
                                        <input type="email" name="email" id="employerEmail" class="form-control"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('web.common.password').":" }}<span
                                                    class="required asterisk-size">*</span></label>
                                        <input type="password" name="password" id="employerPassword"
                                               class="form-control" required>
                                    </div>
                                    <div class="form-group mb30">
                                        <label>{{ __('web.common.confirm_password').":" }}<span
                                                    class="required asterisk-size">*</span></label>
                                        <input type="password" name="password_confirmation" id="employerConfirmPassword"
                                               class="form-control" required>
                                    </div>

                                    <div class="form-check mb30">
                                        <input required class="form-check-input" type="checkbox" value="" id="flexCheckDefaultEmployer">
                                        <label class="form-check-label" for="flexCheckDefaultEmployer">
                                            I accept the <a href="{{route('terms.conditions')}}" class="text-purple" target="_blank">terms and conditions</a>
                                        </label>
                                    </div>

                                    <div class="form-group text-center nomargin">
                                        <button type="submit" class="btn bg-purple form-control" id="btnEmployerSave"
                                                data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">
                                            {{ __('web.register_menu.create_account') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                        <!-- End of Tabpanel for Employer Account -->
                    </div>
                    <!-- End of Tab Content -->

                </div>
            </div>
        </div>
    </section>
    <!-- ===== End of Login - Register Section ===== -->
@endsection

@section('scripts')
    <script>
        let registerSaveUrl = "{{ route('front.save.register') }}";
        let logInUrl = "{{ route('login') }}";
        let hash = window.location.hash;
        if(hash === '#employer'){
            $('#employer-tab').click();
        }else if(hash === '#candidate'){
            $('#candidate-tab').click();
        }
    </script>
    <script src="{{mix('assets/js/front_register/front_register.js')}}"></script>
@endsection
