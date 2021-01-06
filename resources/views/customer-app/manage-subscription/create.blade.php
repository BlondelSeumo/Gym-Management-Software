@extends('layouts.customer-app.basic')

@section('title')
    Fitsigma | Add Subscription
@endsection

@section('CSS')
{!! HTML::style('fitsigma_customer/bower_components/bootstrap-select/bootstrap-select.min.css') !!}
{!! HTML::style('fitsigma_customer/bower_components/custom-select/custom-select.css') !!}
{!! HTML::style('fitsigma_customer/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') !!}
    <style>
        .text-center {
            text-align: center;
        }
        .button-space {
            margin-right: 4px;
        }
    </style>
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Add Subscription</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Main Menu</li>
                <li class="active">Add Subscription</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box p-l-20 p-r-20">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['route'=>'customer-app.manage-subscription.store','id'=>'addSubscriptionStoreForm','class'=>'ajax-form form-material form-horizontal','method'=>'POST']) !!}
                            @if(isset($businesses) && count($businesses) > 0)
                                <div class="form-group">
                                    <label class="col-sm-12">Branch Name</label>
                                    <div class="col-sm-12">
                                        <select class="form-control select2" name="branch_id" id="branch_id">
                                            <option selected disabled>Select Branch</option>
                                            @foreach($businesses as $business)
                                                <option value="{{ $business->id }}">{{ $business->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="col-sm-12">Membership Name</label>
                                <div class="col-sm-12">
                                    <select class="form-control select2" name="membership_id" id="membership_id">
                                        <option selected disabled>Select Membership</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6">Cost</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="cost" id="cost" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6">Joining Date</label>
                                <div class="col-sm-6 input-group">
                                    <input type="text" class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy" name="joining_date">
                                    <span class="input-group-addon"><i class="icon-calender"></i></span>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary waves-effect button-space" id="submit-btn">Submit</button>
                                <button class="btn btn-default waves-effect">Back</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('JS')
{!! HTML::script('fitsigma_customer/bower_components/bootstrap-select/bootstrap-select.min.js') !!}
{!! HTML::script('fitsigma_customer/bower_components/custom-select/custom-select.min.js') !!}
{!! HTML::script('fitsigma_customer/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') !!}
<script>
    $(function () {
        $(".select2").select2();

        $('#branch_id').change(function () {
            $('#membership_id').empty();
            $('#membership_id').append('<option value="" disabled selected>Select Membership</option>');
            var branch_id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{{ route('customer-app.manage-subscription.get-membership') }}',
                data: {
                    'branch_id': branch_id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var membership;
                    $.each(data, function( key, value ) {
                        membership += '<option value="'+ value.id+'">'+ value.title +'</option>'
                    });
                    $('#membership_id').append(membership);
                }
            });
        });

        $('#membership_id').change(function() {
            var membership_id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{{ route('customer-app.manage-subscription.get-membership-amount') }}',
                data: {
                    'membership_id': membership_id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $('#cost').val(data.price);
                }
            });
        });
    });

    $('#submit-btn').click(function () {
        $.easyAjax({
            type: 'POST',
            url: '{{ route('customer-app.manage-subscription.store') }}',
            container: '#addSubscriptionStoreForm',
            data: $('#addSubscriptionStoreForm').serialize()
        });
    });

    $('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
</script>
@endsection