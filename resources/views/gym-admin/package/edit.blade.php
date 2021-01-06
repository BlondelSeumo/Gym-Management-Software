@extends('layouts.gym-merchant.gymbasic')

@section('CSS')

    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') !!}
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
                <a href="{{ route('gym-admin.package.index') }}">Package</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Edit Package</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet light portlet-fit">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-pencil font-red"></i><span class="caption-subject font-red bold uppercase">Edit Package</span></div>


                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                                {!! Form::open(['id'=>'form_sample_3','class'=>'ajax-form','method'=>'POST']) !!}
                                <div class="form-body">


                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" value="{{ $package->title }}" name="title" id="title">
                                        <label for="title">Package Name</label>
                                    </div>

                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <div class="input-group left-addon right-addon">
                                            <span class="input-group-addon"><i class="fa fa-rupee"></i></span>
                                            <input type="text" class="form-control" name="price" value="{{ $package->price }}" id="price">
                                            <span class="help-block">Enter package price.</span>
                                            <span class="input-group-addon">.00</span>
                                            <label for="price">Package Price</label>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <div class="form-group form-md-radios">
                                            <label>Package is for?</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input
                                                            @if($package->package_for == "male")
                                                                    checked
                                                            @endif
                                                            type="radio" value="male" id="male" name="package_for" class="md-radiobtn">
                                                    <label for="male">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Male </label>
                                                </div>
                                                <div class="md-radio ">
                                                    <input type="radio"
                                                           @if($package->package_for == "female")
                                                           checked
                                                           @endif

                                                           value="female" id="female" name="package_for" class="md-radiobtn" >
                                                    <label for="female">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Female </label>
                                                </div>
                                                <div class="md-radio">
                                                    <input type="radio"
                                                           @if($package->package_for == "unisex")
                                                           checked
                                                           @endif

                                                           value="unisex" id="both" name="package_for" class="md-radiobtn">
                                                    <label for="both">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> For Both </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input ">
                                        <textarea class="form-control wysihtml5"  name="details" rows="3">{{ $package->details }}</textarea>
                                        <label for="form_control_1">Package Details</label>
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
                            <!-- END FORM-->
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

    {!! HTML::script('admin/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') !!}


    {!! HTML::script('admin/global/plugins/jquery-validation/js/jquery.validate.min.js') !!}
    {!! HTML::script('admin/global/plugins/jquery-validation/js/additional-methods.min.js') !!}

    <script>
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
                        title: {
                            required: true
                        },
                        price: {
                            required: true,
                            number: true
                        },
                        details: {
                            required: true
                        },
                        package_for: {required: !0}
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
                            url: '{{route('gym-admin.package.update',$package->id)}}',
                            container:'#form_sample_3',
                            type: "PUT",
                            data: $('#form_sample_3').serialize()
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
                jQuery().wysihtml5 && $(".wysihtml5").size() > 0 && $(".wysihtml5").wysihtml5({stylesheets: ["../../../admin/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]})
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