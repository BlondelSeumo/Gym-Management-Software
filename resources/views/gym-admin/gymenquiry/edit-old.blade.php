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
                            <div class="caption font-red sbold uppercase">
                                <i class="fa fa-gift font-red"></i>Members Enquiry </div>
                        </div>
                        <div class="portlet-body">
                            {!! Form::open(['id'=>'form_sample_3','class'=>'ajax-form','method'=>'POST']) !!}
                            <div class="panel-group accordion" id="accordion3">
                                <div class="panel panel-default">
                                    <div class="panel-heading bg-grey-mint">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle accordion-toggle-styled bg-font-grey-mint" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1"> Personal Details </a>
                                        </h4>
                                    </div>
                                    <div id="collapse_3_1" class="panel-collapse in">
                                        <div class="panel-body">

                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                        <select class="form-control" name="title">

                                                            <option value="mr" @if($enquiry->title == 'mr')selected @endif>Mr</option>
                                                            <option value="mrs" @if($enquiry->title == 'mrs')selected @endif>Mrs</option>
                                                            <option value="miss" @if($enquiry->title == 'miss')selected @endif>Miss</option>
                                                        </select>
                                                            <label for="form_control_1">Title </label>
                                                        <div class="form-control-focus"> </div>
                                                    </div></div>

                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="text" class="form-control" name="username" id="username" value="{{$enquiry->username}}">
                                                            <label for="form_control_1">User Name </label>
                                                        <div class="form-control-focus"> </div>
                                                    </div></div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="text" class="form-control" name="last_name" id="last_name" value="{{$enquiry->last_name}}">
                                                            <label for="form_control_1">Last Name </label>
                                                            <div class="form-control-focus"> </div>
                                                    </div></div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input readonly  class="form-control date-picker"  name="birthday" id="birthday"value="@if($enquiry->birthday != '0000-00-00 00:00:00'){{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$enquiry->birthday)->format('m/d/Y') }}@endif">
                                                            <label for="form_control_1">Birthday </label>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                </div></div>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="number" class="form-control" name="age" id="age" value="{{$enquiry->age}}">
                                                            <label for="form_control_1">Age </label>
                                                            <div class="form-control-focus"> </div>
                                                    </div></div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input readonly  class="form-control date-picker"  name="anniversary"  id="anniversary" value="@if($enquiry->anniversary != '0000-00-00 00:00:00'){{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$enquiry->anniversary)->format('m/d/Y') }}@endif">
                                                            <label for="form_control_1">Anniversary </label>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                </div></div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                        <select class="form-control" name="gender">
                                                            <option value="male" @if($enquiry->gender == 'male')selected @endif>Male</option>
                                                            <option value="female"  @if($enquiry->gender == 'female')selected @endif >Female</option>
                                                        </select>
                                                            <label for="form_control_1">Gender </label>
                                                        <div class="form-control-focus"> </div>
                                                    </div></div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                        <select class="form-control" name="marital_status">
                                                            <option value="male"  @if($enquiry->marital_status == 'married')selected @endif>Married</option>
                                                            <option value="female" @if($enquiry->marital_status == 'single')selected @endif>Single</option>
                                                        </select>
                                                            <label for="form_control_1">Marital Status </label>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                </div></div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="text" class="form-control" name="occupation" id="occupation" value="{{$enquiry->occupation}}">
                                                            <label for="form_control_1">Occupation </label>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading bg-grey-mint">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle accordion-toggle-styled collapsed bg-font-grey-mint" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_2"> Contact Details </a>
                                        </h4>
                                    </div>
                                    <div id="collapse_3_2" class="panel-collapse collapse">
                                        <div class="panel-body" style="height:200px; overflow-y:auto;">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="tel" class="form-control" name="phone" id="phone" value="{{$enquiry->phone}}" >
                                                    <span id="phone-error" class="help-block help-block-error"></span>
                                                        <label for="form_control_1">Phone </label>
                                                    <div class="form-control-focus"> </div>
                                                </div></div>

                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input  type="email" class="form-control"  name="email" id="email" value="{{$enquiry->email}}">
                                                        <label for="form_control_1">Email </label>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div></div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                    <textarea class="form-control" name="address" id="address">{{$enquiry->address}}</textarea>
                                                        <label for="form_control_1">Address </label>
                                                        <div class="form-control-focus"> </div>
                                                </div></div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input  type="text" class="form-control"  name="location" id="location" value="{{$enquiry->location}}">
                                                        <label for="form_control_1">Location </label>
                                                        <div class="form-control-focus"> </div>
                                                </div>
                                            </div></div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input  type="text" class="form-control"  name="city" id="city" value="{{$enquiry->city}}">
                                                        <label for="form_control_1">City </label>
                                                        <div class="form-control-focus"> </div>
                                                </div></div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input  type="text" class="form-control"  name="state" id="state" value="{{$enquiry->state}}">
                                                        <label for="form_control_1">State </label>
                                                        <div class="form-control-focus"> </div>
                                                </div>
                                            </div></div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input  type="text" class="form-control"  name="postal_code" id="postal_code" value="{{$enquiry->postal_code}}">
                                                        <label for="form_control_1">Postal Code </label>
                                                        <div class="form-control-focus"> </div>
                                                </div></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading bg-grey-mint">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle accordion-toggle-styled collapsed bg-font-grey-mint" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_3"> Enquiry Type </a>
                                        </h4>
                                    </div>
                                    <div id="collapse_3_3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Enquiry Mode:</label>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-radios">
                                                        <div class="md-radio-inline">
                                                            <div class="md-radio">
                                                                <input type="radio"
                                                                       @if($enquiry->enquire_mode == "walk_in")
                                                                       checked
                                                                       @endif

                                                                       id="walk_in" name="enquire_mode" value="walk_in" class="md-radiobtn">
                                                                <label for="walk_in">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Walk In </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio"
                                                                       @if($enquiry->enquire_mode == "telephonic")
                                                                       checked
                                                                       @endif
                                                                       id="telephonic" name="enquire_mode" class="md-radiobtn" value="telephonic" >
                                                                <label for="telephonic">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Telephonic</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading bg-grey-mint">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle accordion-toggle-styled collapsed bg-font-grey-mint" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_4"> How did you hear about this </a>
                                        </h4>
                                    </div>
                                    <div id="collapse_3_4" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Come To Know From: </label>
                                                <div class="col-md-10">

                                                    <div class="form-group form-md-checkboxes">

                                                        <div class="md-radio-inline">
                                                            <div class="md-radio">
                                                                <input type="radio"
                                                                       @if($enquiry->cometo_know == "advertisement")
                                                                       checked
                                                                       @endif
                                                                       id="advertisement" value="advertisement" class="md-radiobtn" name="cometo_know">
                                                                <label for="advertisement">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> advertisement </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio"
                                                                       @if($enquiry->cometo_know == "tvcable")
                                                                       checked
                                                                       @endif id="tvcable" value="tvcable" class="md-radiobtn" name="cometo_know" >
                                                                <label for="tvcable">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> tvcable </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio"
                                                                       @if($enquiry->cometo_know == "onlinead")
                                                                       checked
                                                                       @endif
                                                                       id="onlinead"  value="onlinead"  class="md-radiobtn" name="cometo_know">
                                                                <label for="onlinead">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Online Ad </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio"
                                                                       @if($enquiry->cometo_know == "justdial")
                                                                       checked
                                                                       @endif
                                                                       id="justdial" value="justdial" class="md-radiobtn" name="cometo_know">
                                                                <label for="justdial">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> justdial </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio"
                                                                       @if($enquiry->cometo_know == "newspaper")
                                                                       checked
                                                                       @endif
                                                                       id="newspaper" value="newspaper" class="md-radiobtn" name="cometo_know">
                                                                <label for="newspaper">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Newspaper </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio"
                                                                       @if($enquiry->cometo_know == "others")
                                                                       checked
                                                                       @endif
                                                                       id="others" class="md-radiobtn" name="cometo_know">
                                                                <label for="others">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Others </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio"
                                                                       @if($enquiry->cometo_know == "friends")
                                                                       checked
                                                                       @endif
                                                                       id="friends" class="md-radiobtn" name="cometo_know">
                                                                <label for="friends">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> friends </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="text" class="form-control" name="referred_by" id="referred_by" value=" {{$enquiry->referred_by}}"/>
                                                        <label for="form_control_1">Referred By </label>
                                                        <div class="form-control-focus"> </div>
                                                </div></div></div>


                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading bg-grey-mint">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle accordion-toggle-styled collapsed bg-font-grey-mint" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_5"> Remark </a>
                                        </h4>
                                    </div>
                                    <div id="collapse_3_5" class="panel-collapse collapse">
                                        <div class="panel-body">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                    <textarea class="form-control" name="query" id="query">{{$enquiry->query}}</textarea>
                                                        <label for="form_control_1">Remark </label>
                                                        <div class="form-control-focus"> </div></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input readonly  class="form-control date-picker"   name="followup_on" id="followup_on" value="@if($enquiry->followup_on != '-0001-11-30 00:00:00' ){{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$enquiry->followup_on)->format('m/d/Y') }}@endif">
                                                        <label for="form_control_1">Next follow up date </label>
                                                    <div class="form-control-focus"> </div>
                                                </div></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <select class="form-control" name="priority" id="priority">
                                                            <option value="low" @if($enquiry->priority == 'low')selected @endif>Low</option>
                                                            <option value="medium" @if($enquiry->priority == 'medium')selected @endif>Medium</option>
                                                            <option value="high" @if($enquiry->priority == 'high')selected @endif >High</option>
                                                        </select>
                                                        <label for="form_control_1">Priority</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn dark mt-ladda-btn ladda-button" data-style="zoom-in" id="save-form">
                                                <span class="ladda-label">
                                                    <i class="fa fa-save"></i> SAVE</span>
                                            <span class="ladda-spinner"></span>
                                            <div class="ladda-progress" style="width: 0px;"></div>
                                        </button>
                                        <button type="reset" class="btn default">Reset</button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>




                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
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

        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true
        });

        var FormValidationMd = function() {

            var handleValidation3 = function() {
                // for more info visit the official plugin documentation:
                // http://docs.jquery.com/Plugins/Validation
                var form1 = $('#form_sample_3');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);

                form1.validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block help-block-error', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    ignore: "", // validate all fields including form hidden input
                    rules: {
                        title:{required:!0},
                        phone: {
                            required: true,
                            number: true
                        },
                        username: {
                            required: true,
                        },
                        last_name: {
                            required: true
                        },
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
                            container:'#form_sample_3',
                            type: "PUT",
                            data: $('#form_sample_3').serialize(),
                            success: function(response){
                                console.log(response);
                                if(response.status == 'fail')
                                {
                                    $("#phone-error").html(response.errors.phone[0]).css('color','red');
                                }
                            }
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


        /*text editor*/
        var ComponentsEditors = function () {
            var t = function () {
                jQuery().wysihtml5 && $(".wysihtml5").size() > 0 && $(".wysihtml5").wysihtml5({stylesheets: ["../../admin/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]})
            }, s = function () {
                //$("#summernote_1").summernote({height: 300})
            };
            return {
                init: function () {
                    t(), s()
                }
            }
        }();


        jQuery(document).ready(function() {
            FormValidationMd.init();
            ComponentsEditors.init();
        });
    </script>
@stop