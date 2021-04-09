@extends('employer.layouts.app')
@section('title')
    {{ __('messages.employer_menu.verification') }}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.employer_menu.verification') }}</h1>
        </div>
        <div class="section-body">
            <div class="row mb-1">
                <div class="col-12">
                    @if($company->verification)
                        <div class="card card-statistic-1 shadow-primary container text-center py-2">
                            <img
                                src="{{asset('assets/images/002-check.svg')}}"
                                alt="triangle with all three sides equal"
                                height="200"
                                width="100" />
                            <p>{{__('messages.verification.verified')}}</p>
                        </div>
                    @elseif($company->verification_attempt)
                        <div class="card card-statistic-1 shadow-primary container text-center py-2">
                            <img
                                src="{{asset('assets/images/001-engineering.svg')}}"
                                alt="triangle with all three sides equal"
                                height="200"
                                width="100" />
                            <p>{{__('messages.verification.processing')}}</p>
                        </div>
                    @else
                        <div class="card card-statistic-1 shadow-primary container">
                        <div class="bs-callout margin-top bs-callout-info" id="callout-labels-inline-block">
                            {{--<h4>Have tons of labels?</h4>--}}
                            <div class="form-group col-sm-12">
                            <p>{{__('messages.long.verification_notice')}}</p>
                            </div>

                            {{ Form::open(['id' => 'verifyForm']) }}
                            <div class="form-group col-sm-12">
                                <strong>{{ Form::label('role_at_company',__('messages.verification.role_at_company').':') }}</strong>
                                {{ Form::text('role_at_company', null, ['class' => 'form-control', 'placeholder' => __('messages.verification.role_placeholder'),'required','id' => 'role_at_company' ]) }}
                            </div>


                            <div class="form-group col-sm-12">
                                <div class="alert-secondary px-3 py-3 mb-2" role="alert">
                                    <span>
                                        <strong>Required Documents:</strong>
                                        @foreach($documents as $document)
                                            <li>{{$document->name}}</li>
                                        @endforeach
                                    </span>
                                </div>
                                <strong>{{ Form::label('attachments:',__('messages.verification.attachments').':') }}</strong>
                                @foreach($documents as $document)
                                    <br><span>{{ Form::label('attachment:', $document->name) }}</span>
                                    {{Form::file('attachment', ['class' => 'form-control  form-control-file attachment', 'required', 'id' => 'attachment-'.$loop->index])}}
                                    <div class="progress mt-2">
                                        <div class="progress-bar" id="resume-progress-{{$loop->index}}" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        {{ Form::hidden('file[]', null, ['class' => 'form-control','required','id' => 'uploaded_file_'.$loop->index ]) }}
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group col-sm-12">
                                {{Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'btn-submit-verification', 'data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> ".__('messages.common.processing')."..."])}}
                            </div>
                            {{ Form::close() }}
                        </div>

                    </div>
                    @endif
                </div>
            </div>
        </div>

        <script>
            let saveUrl = "{{ route('company.verification.save') }}";
            let uploadUrl = "{{ route('company.verification.upload') }}";
            let uploadSuccess = "{{__('messages.verification.upload.success')}}";
            let candidateUrl = "{{ url('candidate') }}/";
            let educationUrl = "{{ url('candidate/candidate-education') }}/";
            let present = "{{ __('messages.candidate_profile.present') }}";
            let isEdit = false;
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{asset('assets/js/companies/verification.js')}}"></script>

    </section>
@endsection

