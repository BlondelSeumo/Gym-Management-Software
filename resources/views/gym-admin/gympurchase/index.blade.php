@extends('layouts.gym-merchant.gymbasic')

@section('CSS')

    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
    {!! HTML::style('admin/pages/css/pricing.min.css') !!}


@stop

@section('content')
    <div class="container-fluid"  >
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{ route('gym-admin.dashboard.index') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Buy Plan</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                @if(\Carbon\Carbon::now('Asia/Calcutta')->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d', $user->trial_end_date), false) < 0 && is_null($activePlan))
                <div class="col-md-12">
                    <div class="alert alert-warning">
                       <i class="fa fa-warning"></i> You have to buy a plan to continue.
                    </div>
                </div>
                @elseif(\Carbon\Carbon::now('Asia/Calcutta')->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d', $user->trial_end_date), false) == 0 && is_null($activePlan))
                <div class="col-md-12">
                    <div class="alert alert-warning">
                       <i class="fa fa-warning"></i> Your trial period is going to end tomorrow.
                    </div>
                </div>
                @endif

                @if(!is_null($activePlan))
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <i class="fa fa-check"></i> Your current plan is <strong>{{ ucwords($activePlan->plan->plan_name) }}</strong>. This plan will expire {{ $activePlan->plan_expires_on->diffForHumans() }}
                        </div>
                    </div>
                @endif

                <div class="col-md-12">

                    <div class="portlet light portlet-fit ">
                        <div class="portlet-title" style="margin-bottom: 0;">
                            <div class="caption">
                                <i class="fa fa-plane font-red"></i>
                                <span class="caption-subject font-red bold uppercase">Choose A Plan</span>
                            </div>
                        </div>
                        <div class="portlet-body no-padding">
                            <div class="pricing-content-2">
                                <div class="row banner">
                                    <div class="col-xs-12">
                                        <img src="{{ asset("admin/pages/img/jaipur.jpg") }}" class="img-responsive" alt="">


                                        <div class="overlay-wrapper">
                                            <div class="overlay-area">
                                                <div class="overlay-content">

                                                    <div class="text-center font-white">

                                                            <div class="field-item hidden-xs"><h1>Choose a plan that's right for your business</h1></div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="pricing-table-container">
                                    <div class="row padding-fix">
                                        @foreach($plans as $key=>$plan)
                                            <div class="col-md-4 no-padding">
                                                <div class="price-column-container
                                                @if(!is_null($plan->discount)) featured-price @endif
                                                @if($key == 0) border-left @endif
                                                @if($key == count($plans)-1) border-right @endif
                                                    border-top">
                                                    @if(!is_null($plan->discount))
                                                        <div class="price-feature-label uppercase bg-green-jungle">Save 20%</div>
                                                    @endif
                                                    <div class="price-table-head @if(!is_null($plan->discount)) price-2 @else price-1 @endif">
                                                        <h2 class="uppercase no-margin">{{ ucwords($plan->plan_name) }}</h2>
                                                    </div>
                                                    <div class="price-table-pricing">
                                                        @if(!is_null($plan->discount))
                                                            <h4>
                                                                <span class="price-sign fa fa-rupee"></span>
                                                                <del>{{ number_format($plan->plan_price + $plan->discount) }}</del>
                                                            </h4>
                                                        @endif
                                                        <h3>
                                                            <span class="price-sign fa fa-rupee"></span>{{ number_format($plan->plan_price) }}</h3>
                                                        <p class="uppercase">for {{ $plan->plan_duration_days }} days</p>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div style="padding: 5px 0" class="bg-grey-salsa font-white uppercase">30-day Free Trial</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="price-table-content">
                                                        @foreach($features as $feat)
                                                            <div class="row no-margin">
                                                                <div class="col-xs-3 text-right">
                                                                    <i class="icon-check font-green"></i>
                                                                </div>
                                                                <div class="col-xs-9 text-left uppercase">{{ $feat->feature_name }}</div>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                    <div class="price-table-footer">
                                                        @if(\Carbon\Carbon::now('Asia/Calcutta')->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d',$user->trial_end_date), false) > 0)
                                                            <button type="button" class="btn yellow-crusta uppercase"><i class="icon-clock"></i> {{ \Carbon\Carbon::now('Asia/Calcutta')->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d', $user->trial_end_date), false). ' Days Trial Remaining' }}</button>
                                                        @elseif(\Carbon\Carbon::now('Asia/Calcutta')->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d', $user->trial_end_date), false) == 0)
                                                            <button type="button" class="btn yellow-crusta uppercase"><i class="icon-clock"></i> Trial ends tomorrow</button>
                                                        @else
                                                            @if(!is_null($activePlan) && $activePlan->plan_id == $plan->id)
                                                                <button type="button" class="btn blue featured-price uppercase">ACTIVE</button>

                                                            @else
                                                                <button type="button" data-plan-id="{{ $plan->id }}" data-plan-name="{{ $plan->plan_name }}" data-plan-duration="{{ $plan->plan_duration_days }}" class="btn green featured-price uppercase buy-plan">buy now</button>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-md-4 no-padding">
                                            <div class="price-column-container border-right border-top">
                                                <div class="price-table-head price-1">
                                                    <h2 class="uppercase no-margin">PRO</h2>
                                                </div>
                                                <div class="price-table-pricing">
                                                    <h3>
                                                        <span class="price-sign fa fa-rupee"></span>NA</h3>
                                                    <p class="uppercase">&nbsp;</p>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div style="padding: 5px 0" class="bg-blue font-white uppercase"><i class="icon-rocket"></i> Upcoming Features</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="price-table-content">
                                                    <div class="row no-margin">
                                                        <div class="col-xs-3 text-right">
                                                            <i class="icon-grid"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-left uppercase">All Features of basic plan</div>
                                                    </div>
                                                    <div class="row no-margin">
                                                        <div class="col-xs-3 text-right">
                                                            <i class="icon-notebook"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-left uppercase">Manage Daily Tasks</div>
                                                    </div>
                                                    <div class="row no-margin">
                                                        <div class="col-xs-3 text-right">
                                                            <i class="icon-speedometer"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-left uppercase">Customer Weight Report</div>
                                                    </div>
                                                    <div class="row no-margin">
                                                        <div class="col-xs-3 text-right">
                                                            <i class="icon-note"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-left uppercase">Create &amp; Send Diet Plan</div>
                                                    </div>
                                                    <div class="row no-margin">
                                                        <div class="col-xs-3 text-right">
                                                            <i class="icon-bubbles"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-left uppercase ">Live Chat With Customer</div>
                                                    </div>
                                                    <div class="row no-margin">
                                                        <div class="col-xs-3 text-right">
                                                            <i class="icon-share"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-left uppercase">Inventory Management</div>
                                                    </div>
                                                    <div class="row no-margin">
                                                        <div class="col-xs-3 text-right">
                                                            <i class="icon-film"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-left uppercase">Exercise Scheduling</div>
                                                    </div>
                                                    <div class="row no-margin">
                                                        <div class="col-xs-3 text-right">
                                                            <i class="icon-user"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-left uppercase">Staff Management</div>
                                                    </div>
                                                    <div class="row no-margin">
                                                        <div class="col-xs-3 text-right">
                                                            <i class="icon-user-follow"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-left uppercase">Referral Management</div>
                                                    </div>
                                                    <div class="row no-margin">
                                                        <div class="col-xs-3 text-right">
                                                            <i class="icon-camera"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-left uppercase">Customer Photo ID Generation</div>
                                                    </div>
                                                    <div class="row no-margin">
                                                        <div class="col-xs-3 text-right">
                                                            <i class="icon-lock"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-left uppercase">Password Protection</div>
                                                    </div>
                                                    <div class="row no-margin">
                                                        <div class="col-xs-3 text-right">
                                                            <i class="icon-note"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-left uppercase">Manage Your Expenses</div>
                                                    </div>
                                                    <div class="row no-margin">
                                                        <div class="col-xs-3 text-right">
                                                            <i class="icon-users"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-left uppercase">Create Group Memberships</div>
                                                    </div>
                                                    <div class="row no-margin">
                                                        <div class="col-xs-3 text-right">
                                                            <i class="icon-graph"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-left uppercase">Track Sales &amp; Marketing Campaigns</div>
                                                    </div>
                                                    <div class="row no-margin">
                                                        <div class="col-xs-3 text-right">
                                                            <i class="icon-grid"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-left uppercase">Customer Portal</div>
                                                    </div>
                                                </div>
                                                <div class="price-table-footer">
                                                    <button type="button" class="btn green featured-price uppercase">COMING SOON</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>


    {{--Modal Start--}}

    <div class="modal fade bs-modal-md in" id="purchase-success-confirmation" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"><i class="icon-rocket"></i> Plan upgraded</span>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center margin-top-15">
                            <i style="font-size: 4rem" class="fa fa-check-circle font-green"></i>
                            <h4 style="margin-top: 25px"><strong>Success!</strong> You have successfully upgraded your plan.</h4>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="dismiss-success-modal" class="btn blue">OK</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{--End Modal--}}

@stop

@section('footer')

    {!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
    {!! HTML::script('admin/pages/scripts/ui-buttons.min.js') !!}

    {!! HTML::script('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}

    {!! HTML::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
    {!! HTML::script('https://checkout.razorpay.com/v1/checkout.js') !!}


    <script>
        $('.buy-plan').click(function () {
            var planName = $(this).data('plan-name');
            var planDuration = $(this).data('plan-duration');
            var planId = $(this).data('plan-id');

            bootbox.confirm({
                message: "Do you want to buy <em><b>"+planName+" ("+planDuration+" days)</b></em> plan?",
                buttons: {
                    confirm: {
                        label: "Yes",
                        className: "btn-primary"
                    }
                },
                callback: function(result){
                    if(result){
                        var url = '{{route('gym-admin.buy-plan.show', ['#id'])}}';
                        url = url.replace('#id', planId);

                        $.easyAjax({
                            'type':'GET',
                            'data':{ _token : '{{csrf_token()}}' },
                            'url': url,
                            success:function (res) {
                                if(res.status == 'success')
                                {
                                    if(sameOrigin){
                                        payCredits(res.payment_id,res.amount);
                                    }
                                    else {
                                        window.parent.postMessage({paymentId: res.payment_id, amount: res.amount},'file://');
                                    }
                                }
                            }
                        })

                    }
                    else {
                        console.log('cancel');
                    }
                }
            })
        });

        $('#dismiss-success-modal').click(function () {
           window.location.reload();
        });
    </script>
    <script>
        function payCredits(id,amount) {
            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}",
                "amount": amount, //in paise
                "name": "FITSIGMA",
                "description": "SMS CREDITS",
                "image": "{{ asset('ace/images/icon.png') }}",
                "handler": function (response) {
                    confirmRazorpayPayment(response.razorpay_payment_id);
                },
                "modal": {
                    "ondismiss": function () {
                        // On dismiss event
                    }
                },
                "prefill": {
                    "name": "{{ $user->first_name }} {{ $user->last_name }}",
                    "email": "{{ $user->email }}"
                },
                "notes": {
                    "purchase_id": id //booking ID
                }
            };
            var rzp1 = new Razorpay(options);

            rzp1.open();
        }

        function confirmRazorpayPayment(id) {
            $.easyAjax({
                type:'POST',
                url:'{{route('gym-admin.buy-plan.store')}}',
                data: {paymentId: id,_token:'{{csrf_token()}}'},
                success: function (res) {
                    if(res.status == 'success')
                    {
                        $('#purchase-success-confirmation').modal('show');
                    }
                }
            })
        }

        /*listen cordova app payment id*/
        window.addEventListener("message", receiveMessage, false);

        function receiveMessage(event)
        {
            var origin = event.origin || event.originalEvent.origin; // For Chrome, the origin property is in the event.originalEvent object.
//            console.log('origin: '+origin+' '+'payid: '+event.data.paymentId);
            if (origin !== "file://" || typeof event.data.paymentId === "undefined")
            {
                return;
            }
//            console.log(event.data.paymentId);
            confirmRazorpayPayment(event.data.paymentId);
        }
    </script>

@stop