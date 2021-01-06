{!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/datepicker.css') !!}
{!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <span class="caption-subject font-red-sunglo bold uppercase"><i class="fa fa-plus"></i> Follow Up</span>
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
            <div class="form-group form-md-line-input">
                <label class="control-label">Package offered</label>
                <div class="form-group form-md-radios">
                    <div class="md-radio-inline">
                        <div class="md-radio">
                            <input type="radio" id="package-monthly" checked name="packages_offered" value="Monthly" class="md-radiobtn">
                            <label for="package-monthly">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span> Monthly </label>
                        </div>
                        <div class="md-radio">
                            <input type="radio" id="package-quarterly" name="packages_offered" class="md-radiobtn" value="Quarterly" >
                            <label for="package-quarterly">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span> Quarterly</label>
                        </div>
                        <div class="md-radio">
                            <input type="radio" id="package-half-yearly" name="packages_offered" class="md-radiobtn" value="Half Yearly" >
                            <label for="package-half-yearly">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span> Half Yearly</label>
                        </div>

                        <div class="md-radio">
                            <input type="radio" id="package-yearly" name="packages_offered" class="md-radiobtn" value="Yearly" >
                            <label for="package-yearly">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span> Yearly</label>
                        </div>

                    </div>

                    <div class="md-radio-inline">
                        <div class="md-radio">
                            <input type="radio" id="package-personal-training" name="packages_offered" class="md-radiobtn" value="Personal Training" >
                            <label for="package-personal-training">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span> Personal Training</label>
                        </div>
                        <div class="md-radio">
                            <input type="radio" id="package-other" name="packages_offered" class="md-radiobtn" value="Any Other" >
                            <label for="package-other">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span> Any Other</label>
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-group form-md-line-input ">
                <textarea name="remark" class="form-control" id="remark" cols="30" rows="3"></textarea>
                <label for="form_control_1">Remark</label>
                <div class="form-control-focus"></div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group form-md-line-input ">
                        <input type="number" class="form-control" id="package_amount" name="package_amount" />
                        <label for="form_control_1">Package amount</label>
                        <div class="form-control-focus"></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group form-md-line-input ">
                        <input type="text" class="form-control" id="counselor_name" name="counselor_name" value="{{ ucwords($user->first_name.' '.$user->last_name) }}" readonly />
                        <label for="form_control_1">Name of the counsellor</label>
                        <div class="form-control-focus"></div>
                        <span class="help-block">*This cannot be changed</span>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group form-md-line-input ">
                        <input type="text" class="form-control date-picker" id="next_follow_up_on" name="next_follow_up_on" readonly data-provide="datepicker" data-date-start-date="-0d" data-date-autoclose="true" value="{{ \Carbon\Carbon::today()->addWeek()->format('m/d/Y') }}" />
                        <label for="form_control_1">Next follow up on?</label>
                        <div class="form-control-focus"></div>
                    </div>

                </div>


            </div>


        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:;" class="btn blue" id="add-follow-up" >Save</a>
    </div>
    {!! Form::close() !!}
</div>

{!! HTML::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
{!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}