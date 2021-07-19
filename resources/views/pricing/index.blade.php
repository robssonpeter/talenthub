@extends('employer.layouts.app')
@section('title')
    {{ __('messages.employer_menu.manage_subscriptions') }}
@endsection
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card-body">
                <div class="row justify-content-around d-flex mt-xl-0 mt-5">
                    @foreach($plans as $plan)
                        @if($plan->subscribed || $plan->is_active)
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                            <div class="pricing {{ isset($subscription) && $subscription->plan_id == $plan->id && $subscription->stripe_status == 'trialing' ? 'pricing-highlight pricing-margin-bottom' : '' }} {{ isset($subscription) && $subscription->plan_id == $plan->id ? 'pricing-highlight' : '' }}">
                                <div class="pricing-title">
                                    {{ $plan->name }}
                                </div>
                                <div class="pricing-padding h-317">
                                    <div class="pricing-price">
                                        <div>{{ $plan->currency->currency_icon.$plan->amount }}</div>
                                        <div>{{ "Per ".$plan->per  }}</div>
                                    </div>
                                    <div class="pricing-details">
                                        <div class="pricing-item">
                                            <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                            <div class="pricing-item-label">{{ $plan->allowed_jobs.' '.($plan->allowed_jobs > 1 ? __('messages.plan.jobs_allowed') : __('messages.plan.job_allowed')) }}</div>
                                        </div>
                                        <div class="pricing-item">
                                            @if($plan->is_trial_plan)
                                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                            @else
                                                <div class="pricing-item-icon bg-danger text-white"><i
                                                            class="fas fa-times"></i></div>
                                            @endif
                                            <div class="pricing-item-label">{{ __('messages.plan.is_trial_plan') }}</div>
                                        </div>
                                        @if(isset($subscription) && $subscription->plan_id == $plan->id)
                                            <div class="pricing-item">
                                                <div class="pricing-item-icon"><i class="fas fa-briefcase"></i></div>
                                                <div class="pricing-item-label">{{ $jobsCount.' '.($jobsCount > 1 ? __('messages.plan.jobs_used') : __('messages.plan.job_used'))}}</div>
                                            </div>
                                            @if($subscription->stripe_status != 'trialing')
                                                @if(isset($subscription->ends_at))
                                                    <div class="pricing-item">
                                                        <div class="pricing-item-icon"><i class="fas fa-clock"></i>
                                                        </div>
                                                        <div class="pricing-item-label">{{ __('messages.plan.ends_at').': '.\Carbon\Carbon::parse($subscription->ends_at)->format('jS M,Y') }}</div>
                                                    </div>
                                                @else
                                                    <div class="pricing-item">
                                                        <div class="pricing-item-icon"><i class="fas fa-clock"></i>
                                                        </div>
                                                        <div class="pricing-item-label">{{ __('messages.plan.renews_on').': '.\Carbon\Carbon::parse($subscription->current_period_end)->format('jS M,Y') }}</div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="pricing-cta">
                                    @if(isset($subscription) && $subscription->plan_id == $plan->id)
                                        <a href="javascript:void(0)">{{ __('messages.plan.current_plan') }} </a>
                                        @if($subscription->stripe_status != 'trialing')
                                            @if(isset($subscription->ends_at))
                                                <a href="javascript:void(0)"
                                                   class="subscription">{{ __('messages.plan.subscription_cancelled') }}</a>
                                            @else
                                                <a href="javascript:void(0)"
                                                   class="cancel-subscription" id="{{$subscription->id}}" >{{ __('messages.plan.cancel_subscription') }}</a>
                                            @endif
                                        @endif
                                    @else
                                        @if($plan->is_trial_plan)
                                            <a href="javascript:void(0)" id="purchase-plan-{{ $plan->id }}" data-id="{{ $plan->id }}"
                                               class="subscribe-trial">{{ __('messages.plan.purchase') }}</a>
                                        @else
                                            <a href="javascript:void(0)" id="purchase-plan-{{ $plan->id }}" data-id="{{ $plan->id }}"
                                               class="subscribe">{{ $plan->subscribed?'Activate':__('messages.plan.purchase') }} </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                @include('pricing.cancel_subscription_modal')
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        let success = '';
        let stripe = Stripe('{{ config('services.stripe.key') }}');
        let dpo_token = "{{env('DPO_COMPANY_TOKEN')}}";
        let subscribeText = "{{ __('messages.plan.purchase') }}";
        let cancelSubscriptionUrl = "{{ route('cancel-subscription') }}";
        let purchaseTriaalSubscriptionUrl = "{{ route('purchase-trial-subscription') }}";
    </script>
    @if(session()->has('success'))
        <script>
            success = "{{session()->get('success')}}";
        </script>
        @php
            session()->remove('success');
        @endphp
    @endif

    @php
    $renew = session()->get('renew');
    $subscription = session()->get('subscription');
    //dd($renew->id);
    @endphp
    @if(session()->has('renew'))
        <script>
            plan = @json(session()->get('renew'));

            console.log(plan);
            let element = document.getElementById('purchase-plan-{{$renew->id}}');
            if(element === null) {
                swal('Subscribed', 'You are already subscribed to this plan', 'success');
            }else{
                swal({
                    title: 'Confirm',
                    text: 'Are you sure want to renew '+plan.name+' ?',
                    type: 'warning',
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonColor: '#6777ef',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes',
                }, function () {
                    console.log('#purchase-plan-'+plan.id);

                    console.log(element);
                    element.click();
                    //$('#purchase-plan-{{$renew->id}}').click();
                });
            }
        </script>
    @endif

    {{--@if($renew && $subscription->active())
        <script>

        </script>
    @endif--}}

    <script src="{{ mix('assets/js/subscription/subscription.js') }}"></script>
@endpush
