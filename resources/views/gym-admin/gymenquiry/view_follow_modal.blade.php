{!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/datepicker.css') !!}
{!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <span class="caption-subject font-red-sunglo bold uppercase"><i class="fa fa-list"></i> Follow Up History</span>
</div>
<div class="modal-body">
    {!! Form::open(['id'=>'followUpForm','class'=>'ajax-form']) !!}

    <input type="hidden" name="enquiry_id" value="{{ $enquiry->id }}">

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label sbold">Customer Name:</label>
                <p class="form-control-static"> {{ ucwords($enquiry->customer_name) }} </p>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label sbold">Mobile:</label>
                <p class="form-control-static"> {{ $enquiry->mobile }} </p>
            </div>
        </div>
        <!--/span-->
    </div>

    <div class="row">
        <div class="col-md-12 ">
            <div class="list-group" style="max-height: 400px; overflow-y: auto;">
                @foreach($follows as $follow)
                    <a href="javascript:;" class="list-group-item">
                        <h4 class="list-group-item-heading sbold">Date: {{ $follow->follow_up_date->toFormattedDateString() }}</h4>
                        <p class="list-group-item-text">
                            <div class="row">
                                <div class="col-md-6">
                                    Package offered: {{ $follow->packages_offered }}
                                </div>
                                <div class="col-md-6">
                                    Package amount: {!!  ($follow->package_amount != '') ? '<i class="fa '.$gymSettings->currency->symbol.'"></i> '.$follow->package_amount : "Not set" !!}
                                </div>
                            </div>
                            <div class="row margin-top-5">
                                <div class="col-md-12">
                                    Remark: <br>
                                    {!!  ($follow->remark != '') ? ucfirst($follow->remark) : "<span class='font-red'>Empty</span>" !!}

                                </div>
                            </div>
                            <div class="row margin-top-5">
                                <div class="col-md-6">
                                    Counsellor: {{ ucwords($follow->counselor_name) }}
                                </div>
                                <div class="col-md-6">
                                    Next Follow Up: {{ $follow->next_follow_up_on->toFormattedDateString() }}
                                </div>
                            </div>
                        </p>
                    </a>
                @endforeach

            </div>

        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:;" class="btn blue"  data-dismiss="modal" aria-hidden="true" >OK</a>
    </div>
    {!! Form::close() !!}
</div>

{!! HTML::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
{!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}