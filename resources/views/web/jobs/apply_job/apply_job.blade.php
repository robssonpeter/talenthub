@extends('web.layouts.app')
@section('title')
{{ __('web.job_details.apply_for_job') }}
@endsection
@section('css')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection
@section('content')
    <section class="page-header">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h2>{{ __('web.apply_for_job.apply_for') }} <span class="text-blue">{{ $job->job_title }}</span>
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <!-- ===== Start of Main Wrapper Job Section ===== -->
    <section class="ptb80" id="job-page">
        <div class="container">
            @if($isApplied)
                <h3 class="uppercase text-blue">{{ __('web.job_details.already_applied') }}</h3>
                <div class="row account-question">
                    <div class="col-md-10 nopadding">
                        <p class="nomargin">
                            {{ __('web.apply_for_job.we_received_your_application') }}
                        </p>
                    </div>
                </div>
            @else
                <h3 class="uppercase text-blue">{{ __('web.apply_for_job.fill_details') }}</h3>
                <div class="row account-question">
                    <div class="col-md-10 nopadding">
                        <p class="nomargin">
                            @if($job->is_suspended)
                                {{ 'job is suspended' }}
                            @elseif(!$isActive)
                                {{ 'job is '.\App\Models\Job::STATUS[$job->status] }}
                            @else
                                {{ __('web.apply_for_job.due_to_our_continued_growth') }} {{ $job->job_title }} {{ __('web.apply_for_job.or_words_to_that_effect') }}
                            @endif

                            .
                        </p>
                    </div>
                </div>
                <form id="applyJobForm" class="post-job-resume mt50">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" value="{{ isset($job) ? $job->id : null }}" name="job_id">
                            <div class="form-group col-sm-12 mt10 ">
                                <label for="resumeId">{{ __('messages.apply_job.resume').':' }}<span
                                            class="required asterisk-size">*</span></label>
                                {{ Form::select('resume_id', $resumes, ($isJobDrafted) ? $draftJobDetails->resume_id : null, ['class' => 'selectpicker','id' => 'resumeId','placeholder'=>'Select Resume', 'required']) }}
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="expected_salary">{{ __('messages.candidate.expected_salary').' ('.$job->currency->currency_icon.'):' }}<span
                                            class="required asterisk-size">*</span></label>
                                <input type="text" id="expected_salary" name="expected_salary"
                                       placeholder="{{__('messages.job.net_amount')}}"
                                       value="{{ ($isJobDrafted) ? $draftJobDetails->expected_salary : '' }}"
                                       class="form-control price-input" required>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="notes">{{ __('messages.applied_job.cover_letter').':' }}<span
                                        class="required asterisk-size">{{$job->require_cover_letter?'*':''}}</span></label>
                                <div id="message" class="mb-3">

                                </div>
                                <input type="hidden" rows="5" id="cover_letter" name="cover_letter"
                                          {{$job->require_cover_letter?'required':''}}
                                          placeholder="{{$job->require_cover_letter?'Required':'Optional'}}"
                                          class="form-control" value="{{ ($isJobDrafted) ? $draftJobDetails->cover_letter : '' }}">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="notes">{{ __('messages.apply_job.notes').':' }}</label>
                                <textarea rows="5" id="notes" name="notes"
                                          class="form-control">{{ ($isJobDrafted) ? $draftJobDetails->notes : '' }}</textarea>
                            </div>
                            <div class="form-group pt30 nomargin text-right" id="last">
                                @if(!$isApplied)
                                    @if(!$isJobDrafted)
                                        <button class="btn btn-red btn-effect save-draft mr-1 submit">Save as Draft</button>
                                    @endif
                                    @if($isActive && !$job->is_suspended)
                                        <button class="btn btn-blue btn-effect apply-job submit">{{ __('web.common.apply') }}</button>
                                    @endif
                                @else
                                    <button class="btn btn-green btn-effect">{{ __('web.apply_for_job.already_applied') }}</button>
                                @endif

                            </div>
                        </div>
                    </div>

                </form>
            @endif
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://unpkg.com/turndown/dist/turndown.js"></script>
    <script>
        let requireCoverLetter = false;
        var toolbarOptions = [
            'bold', 'italic', 'underline',
            { 'list': 'ordered'},
            { 'list': 'bullet' },
            {'align': 'center'},
            {'align': 'right'},
            {'align': 'justify'}];
        var quill = new Quill('#message', {
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: 'Type your cover letter here',
            theme: 'snow',
        });
    </script>
    @if($job->require_cover_letter)
    <script>
        requireCoverLetter = "{{$job->require_cover_letter}}";
        alert(requireCoverLetter);
        var turndownService = new TurndownService();
        $(document).on('click', '.submit', function(event){
            let markdown = turndownService.turndown(quill.root.innerHTML);
            //$("#cover_letter").val(quill.root.innerHTML);
            $("#cover_letter").val(markdown);
            event.preventDefault();
        });
    </script>
    @endif
    <script>
        let applyJobUrl = "{{ route('apply-job') }}";
        let jobDetailsUrl = "{{ url('job-details') }}";
        $('#resumeId').selectpicker();
    </script>
    <script src="{{mix('assets/js/custom/input_price_format.js')}}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ mix('assets/js/jobs/front/apply_job.js') }}"></script>
@endsection

