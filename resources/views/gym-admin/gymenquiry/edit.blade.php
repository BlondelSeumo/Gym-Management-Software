@extends('layouts.gym-merchant.gymbasic')

@section('CSS')

    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/datepicker.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}


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
                <a href="{{ route('gym-admin.enquiry.index') }}">Enquiry</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Edit Enquiry</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption font-red">
                                <i class="bold uppercase font-red fa fa-pencil"></i> Edit Enquiry </div>
                        </div>

                        <div class="portlet-body form">
                            {!! Form::open(['id'=>'form_sample_','class'=>'ajax-form','method'=>'POST']) !!}

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input ">
                                            <input type="text" readonly data-provide="datepicker" data-date-end-date="0d" data-date-today-highlight="true" class="form-control date-picker" value="{{ $enquiry->enquiry_date->format('m/d/Y') }}" name="enquiry_date" id="enquiry_date">
                                            <label for="form_control_1">Enquiry Date</label>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input ">
                                            <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{ $enquiry->customer_name }}">
                                            <label for="form_control_1">Customer Name</label>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input">
                                            <input type="tel" class="form-control" name="mobile" id="mobile" value="{{ $enquiry->mobile }}">
                                            <label for="form_control_1">Mobile</label>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input">
                                            <input type="email" class="form-control" name="email" id="email" value="{{ $enquiry->email }}">
                                            <label for="form_control_1">Customer Email</label>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group form-md-line-input ">
                                    <textarea name="address" class="form-control" id="address" cols="30" rows="3">{{ $enquiry->address }}</textarea>
                                    <label for="form_control_1">Address</label>
                                    <div class="form-control-focus"></div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input ">
                                            <input type="text" readonly class="form-control date-picker" data-provide="datepicker" data-date-end-date="0d" data-date-start-view="decades" data-date-autoclose="true" name="dob" id="dob" value="{{ $enquiry->dob->format('m/d/Y') }}">
                                            <label for="form_control_1">Date of Birth</label>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <input type="number" min="0" class="form-control" name="age" id="age" value="{{ $enquiry->age }}">
                                            <label for="form_control_1">Age</label>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <div class="form-group form-md-radios">
                                                <div class="md-radio-inline">
                                                    <div class="md-radio">
                                                        <input type="radio" id="sex-1"
                                                               @if($enquiry->sex == "male") checked @endif name="sex" value="Male" class="md-radiobtn">
                                                        <label for="sex-1">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Male </label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" id="sex-2" @if($enquiry->sex == "female") checked @endif name="sex" class="md-radiobtn" value="Female" >
                                                        <label for="sex-2">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Female</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <input type="number" min="0" class="form-control" value="{{ $enquiry->height_feet }}" name="height_feet" id="height_feet">
                                            <label for="form_control_1">Height Feet</label>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <input type="number" min="0" class="form-control" value="{{ $enquiry->height_inches }}" name="height_inches" id="height_inches">
                                            <label for="form_control_1">Height Inches</label>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <input type="number" min="0" class="form-control" value="{{ $enquiry->weight }}" name="weight" id="weight">
                                            <label for="form_control_1">Weight</label>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="control-label">Occupation</label>
                                    <div class="form-group form-md-radios">
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" id="professional" @if($enquiry->occupation == "Professional") checked @endif name="occupation" value="Professional" class="md-radiobtn">
                                                <label for="professional">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Professional </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="business" @if($enquiry->occupation == "Business") checked @endif name="occupation" class="md-radiobtn" value="Business" >
                                                <label for="business">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Business</label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="service" @if($enquiry->occupation == "Service") checked @endif name="occupation" class="md-radiobtn" value="Service" >
                                                <label for="service">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Service</label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="homemaker" @if($enquiry->occupation == "Homemaker") checked @endif name="occupation" class="md-radiobtn" value="Homemaker" >
                                                <label for="homemaker">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Homemaker</label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="student" @if($enquiry->occupation == "Student") checked @endif name="occupation" class="md-radiobtn" value="Student" >
                                                <label for="student">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Student</label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="other" @if($enquiry->occupation == "Other") checked @endif name="occupation" class="md-radiobtn" value="Other" >
                                                <label for="other">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Other</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="control-label">How did you get to know about us?</label>
                                    <div class="form-group form-md-radios">
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" id="news-paper" @if($enquiry->come_to_know == "News paper") checked @endif name="come_to_know" value="News paper" class="md-radiobtn">
                                                <label for="news-paper">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> News paper </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="hoarding" @if($enquiry->come_to_know == "Hoarding") checked @endif  name="come_to_know" value="Hoarding" class="md-radiobtn">
                                                <label for="hoarding">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Hoarding</label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="existing-member" @if($enquiry->come_to_know == "Existing Member") checked @endif name="come_to_know" value="Existing Member" class="md-radiobtn">
                                                <label for="existing-member">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Existing Member</label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="family" @if($enquiry->come_to_know == "Family") checked @endif name="come_to_know" value="Family" class="md-radiobtn">
                                                <label for="family">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Family </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="friends" @if($enquiry->come_to_know == "Friends") checked @endif name="come_to_know" value="Friends" class="md-radiobtn">
                                                <label for="friends">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Friends </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="doctor" @if($enquiry->come_to_know == "Doctor") checked @endif name="come_to_know" value="Doctor" class="md-radiobtn">
                                                <label for="doctor">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Doctor </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="old-member" @if($enquiry->come_to_know == "Old Member") checked @endif name="come_to_know" value="Old Member" class="md-radiobtn">
                                                <label for="old-member">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Old Member </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="just-dial" @if($enquiry->come_to_know == "Just Dial") checked @endif name="come_to_know" value="Just Dial" class="md-radiobtn">
                                                <label for="just-dial">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Just Dial </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="huntplex-com" @if($enquiry->come_to_know == "Huntplex") checked @endif name="come_to_know" value="Huntplex" class="md-radiobtn">
                                                <label for="huntplex-com">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Huntplex.com </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="others" @if($enquiry->come_to_know == "Others") checked @endif name="come_to_know" value="Others" class="md-radiobtn">
                                                <label for="others">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Others </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Goal</label>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group form-md-radios">
                                                <div class="md-radio-inline">
                                                    <div class="md-radio">
                                                        <input type="radio" id="weight-loss" @if($enquiry->customer_goal == "Weight Loss") checked @endif name="customer_goal" value="Weight Loss" class="md-radiobtn">
                                                        <label for="weight-loss">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Weight Loss </label>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group form-md-line-input">
                                            <label for="form_control_1" class="control-label">If weight loss how much?</label>
                                                <input type="number" min="0" class="form-control" value="{{ $enquiry->weight_loss_amount }}" name="weight_loss_amount" id="weight_loss_amount">
                                                <span class="help-block">In Kg</span>
                                                <div class="form-control-focus"> </div>

                                        </div>
                                    </div>

                                    <div class="col-md-2 col-md-offset-1">
                                        <div class="form-group form-md-radios">
                                                <div class="md-radio-inline">
                                                    <div class="md-radio">
                                                        <input type="radio" id="weight-gain" @if($enquiry->customer_goal == "Weight Gain") checked @endif name="customer_goal" value="Weight Gain" class="md-radiobtn">
                                                        <label for="weight-gain">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Weight Gain </label>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group form-md-line-input">
                                            <label for="form_control_1" class="control-label">If weight gain how much?</label>
                                                <input type="number" min="0" class="form-control" value="{{ $enquiry->weight_gain_amount }}" name="weight_gain_amount" id="weight_gain_amount">
                                                <span class="help-block">In Kg</span>
                                                <div class="form-control-focus"> </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group form-md-radios">
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio" id="flexibility" @if($enquiry->customer_goal == "Flexibility") checked @endif name="customer_goal" value="Flexibility" class="md-radiobtn">
                                                    <label for="flexibility">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Flexibility </label>
                                                </div>
                                                <div class="md-radio">
                                                    <input type="radio" id="injury-rehabilitation" @if($enquiry->customer_goal == "Injury Rehabilitation") checked @endif name="customer_goal" class="md-radiobtn" value="Injury Rehabilitation" >
                                                    <label for="injury-rehabilitation">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Injury Rehabilitation</label>
                                                </div>
                                                <div class="md-radio">
                                                    <input type="radio" id="yoga" @if($enquiry->customer_goal == "Yoga") checked @endif name="customer_goal" class="md-radiobtn" value="Yoga" >
                                                    <label for="yoga">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Yoga</label>
                                                </div>
                                                <div class="md-radio">
                                                    <input type="radio" id="toning" @if($enquiry->customer_goal == "Toning") checked @endif name="customer_goal" class="md-radiobtn" value="Toning" >
                                                    <label for="toning">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Toning</label>
                                                </div>
                                                <div class="md-radio">
                                                    <input type="radio" id="stress-management" @if($enquiry->customer_goal == "Stress Management") checked @endif name="customer_goal" class="md-radiobtn" value="Stress Management" >
                                                    <label for="stress-management">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Stress Management</label>
                                                </div>
                                                <div class="md-radio">
                                                    <input type="radio" id="cardio-vascular-endurance" @if($enquiry->customer_goal == "Cardio Vascular Endurance") checked @endif name="customer_goal" class="md-radiobtn" value="Cardio Vascular Endurance" >
                                                    <label for="cardio-vascular-endurance">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Cardio Vascular Endurance</label>
                                                </div>
                                                <div class="md-radio">
                                                    <input type="radio" id="strength-endurance" @if($enquiry->customer_goal == "Strength Endurance") checked @endif name="customer_goal" class="md-radiobtn" value="Strength Endurance" >
                                                    <label for="strength-endurance">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Strength Endurance</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <hr>

                                <div class="form-group form-md-line-input">
                                    <label class="control-label">Do you exercise regularly?</label>
                                    <div class="form-group form-md-radios">
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" id="exercise-yes" @if($enquiry->exercise_regularly == "yes") checked @endif name="exercise_regularly" value="Yes" class="md-radiobtn">
                                                <label for="exercise-yes">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Yes </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="exercise-no" @if($enquiry->exercise_regularly == "no") checked @endif name="exercise_regularly" class="md-radiobtn" value="No" >
                                                <label for="exercise-no">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> No</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input exercise-type @if($enquiry->exercise_regularly == "no") hide @endif">
                                    <label class="control-label">If yes what type?</label>
                                    <div class="form-group form-md-radios">
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" id="exercise-type-gym" @if($enquiry->exercise_type == "Gym") checked @endif name="exercise_type" value="Gym" class="md-radiobtn">
                                                <label for="exercise-type-gym">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Gym </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="exercise-type-aerobics" @if($enquiry->exercise_type == "Aerobics") checked @endif name="exercise_type" value="Aerobics" class="md-radiobtn">
                                                <label for="exercise-type-aerobics">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Aerobics </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="exercise-type-yoga" @if($enquiry->exercise_type == "Yoga") checked @endif name="exercise_type" value="Yoga" class="md-radiobtn">
                                                <label for="exercise-type-yoga">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Yoga </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="exercise-type-walking" @if($enquiry->exercise_type == "Walking") checked @endif name="exercise_type" value="Walking" class="md-radiobtn">
                                                <label for="exercise-type-walking">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Walking </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="exercise-type-jogging" @if($enquiry->exercise_type == "Jogging") checked @endif name="exercise_type" value="Jogging" class="md-radiobtn">
                                                <label for="exercise-type-jogging">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Jogging </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="exercise-type-spinning" @if($enquiry->exercise_type == "Spinning") checked @endif name="exercise_type" value="Spinning" class="md-radiobtn">
                                                <label for="exercise-type-spinning">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Spinning </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group form-md-line-input">
                                            <div class="row">
                                                <label class="col-md-4 control-label">If gyming where?</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="gyming_where" id="gyming_where" value="{{ $enquiry->gyming_where }}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <div class="row">
                                                <label class="control-label col-md-5">How much time?</label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" value="{{ $enquiry->gyming_since }}" name="gyming_since" id="gyming_since">
                                                    <div class="form-control-focus"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-actions noborder">
                                <button  type="submit" class="btn dark mt-ladda-btn ladda-button" data-style="zoom-in" id="save-form">
                                            <span class="ladda-label">
                                                <i class="fa fa-save"></i> Update</span>
                                    <span class="ladda-spinner"></span>
                                    <div class="ladda-progress" style="width: 0px;"></div>
                                </button>
                                <button  type="reset" class="btn default">Reset</button>
                            </div>

                        </div>




                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
@stop

@section('footer')

            {!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
            {!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
            {!! HTML::script('admin/pages/scripts/ui-buttons.min.js') !!}

            {!! HTML::script('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}

            {!! HTML::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
            {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
            {!! HTML::style('admin/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}


            {!! HTML::script('admin/global/plugins/jquery-validation/js/jquery.validate.min.js') !!}
            {!! HTML::script('admin/global/plugins/jquery-validation/js/additional-methods.min.js') !!}


            <script>

                $('#dob').change(function () {
                    var lre = /^\s*/;

                    var inputDate = document.getElementById('dob').value;
                    inputDate = inputDate.replace(lre, "");

                    age=get_age(new Date(inputDate));

                    $('#age').val(age);

                });

                function get_age(birth) {
                    var today = new Date();
                    var nowyear = today.getFullYear();
                    var nowmonth = today.getMonth();
                    var nowday = today.getDate();

                    var birthyear = birth.getFullYear();
                    var birthmonth = birth.getMonth();
                    var birthday = birth.getDate();

                    var age = nowyear - birthyear;
                    var age_month = nowmonth - birthmonth;
                    var age_day = nowday - birthday;

                    if(age_month < 0 || (age_month == 0 && age_day <0)) {
                        age = parseInt(age) -1;
                    }
                    return age;


                }

                var FormValidationMd = function() {

                    var handleValidation3 = function() {
                        // for more info visit the official plugin documentation:
                        // http://docs.jquery.com/Plugins/Validation
                        var form1 = $('#form_sample_');
                        var error1 = $('.alert-danger', form1);
                        var success1 = $('.alert-success', form1);

                        form1.validate({
                            errorElement: 'span', //default input error message container
                            errorClass: 'help-block help-block-error', // default input error message class
                            focusInvalid: false, // do not focus the last invalid input
                            ignore: "", // validate all fields including form hidden input
                            rules: {
                                mobile: {
                                    required: true,
                                    number: true
                                },
                                customer_name: {
                                    required: true,
                                },
                                age:{
                                    number: true
                                }

                            },

                            invalidHandler: function(event, validator) { //display error alert on form submit
                                success1.hide();
                                error1.show();
                                App.scrollTo(error1, -200);
                            },

                            errorPlacement: function(error, element) {
                                if (element.is(':checkbox')) {
                                    error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                                } else if (element.is(':radio')) {
                                    error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                                } else {
                                    error.insertAfter(element); // for other inputs, just perform default behavior
                                }
                            },

                            highlight: function(element) { // hightlight error inputs
                                $(element)
                                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                            },

                            unhighlight: function(element) { // revert the change done by hightlight
                                $(element)
                                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                            },

                            success: function(label) {
                                label
                                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                            },

                            submitHandler: function(form) {
                                success1.show();
                                error1.hide();


                                $.easyAjax({
                                    url: '{{route('gym-admin.enquiry.update',$enquiry->id)}}',
                                    container:'#form_sample_',
                                    type: "PUT",
                                    data: $('#form_sample_').serialize()
                                });
                                // $( '#save-form' ).ladda();
                                return false;
                            }
                        });
                    }

                    return {
                        //main function to initiate the module
                        init: function() {
                            handleValidation3();
                        }
                    };
                }();




                jQuery(document).ready(function() {
                    FormValidationMd.init();
//            ComponentsEditors.init();
                });

                $(function() {
                    $("input[name='exercise_regularly']").change(function() {
                        if($(this).val() == 'Yes') {
                            $('.exercise-type').css('display','block');
                            $('.exercise-type').removeClass('hide');
                        } else {
                            $('.exercise-type').css('display','none');
                        }
                    });
                });
            </script>
@stop