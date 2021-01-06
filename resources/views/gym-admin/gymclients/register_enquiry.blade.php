@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
{!! HTML::style('front/js/cropper/cropper.min.css?v=1.0')!!}
{!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/datepicker.css') !!}
{!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
{!! HTML::style('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
{!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
@stop

@section('content')
    <div class="container-fluid">
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{route('gym-admin.dashboard.index')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{route('gym-admin.client.index')}}">Customer</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Add</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">

            @if($completedItems  < $completedItemsRequired)
                {{-- Account setup progress start --}}

                <div class="row">

                    <div class="col-md-12">
                        <div class="portlet dark box">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-speedometer font-white"></i>
								<span class="caption-subject  font-white">
								Account Setup Progress </span>
                                    <span class="caption-helper">{{ round($completedItems*(100/$completedItemsRequired),1) }}% COMPLETE</span>
                                </div>
                            </div>
                            <div class="portlet-body">

                                <div class="col-md-12">
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar"
                                             aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                             style="width: {{ ($completedItems*(100/$completedItemsRequired)) }}%">
									<span class="sr-only">
									{{ ($completedItems*(100/$completedItemsRequired)) }}% Complete </span>
                                        </div>
                                    </div>
                                </div>

                                @if(trim($user->first_name) == "" || trim($user->last_name) == "")
                                    <div class="col-md-12">
                                        <strong>Next Step:</strong>
                                        <a href="{{ route('gym-admin.profile.index') }}">
                                            Update your first & last name


                                            <i class="fa fa-arrow-right"></i>
                                        </a>

                                    </div>

                                @elseif(trim($user->mobile) == "")
                                    <div class="col-md-12">
                                        <strong>Next Step:</strong>
                                        <a href="{{ route('gym-admin.profile.index') }}">
                                            Update your mobile number

                                            <i class="fa fa-arrow-right"></i>
                                        </a>

                                    </div>

                                @elseif(count($memberships) == 0)
                                    <div class="col-md-12">
                                        <strong>Next Step:</strong>
                                        <a href="{{ URL::route('gym-admin.membership.create') }}">
                                            Add Membership

                                            <i class="fa fa-arrow-right"></i>
                                        </a>

                                    </div>

                                @elseif(count($clients) == 0)
                                    <div class="col-md-12">
                                        <strong>Next Step:</strong>
                                        <a href="{{ route('gym-admin.client.create') }}">
                                            Add First Client

                                            <i class="fa fa-arrow-right"></i>
                                        </a>

                                    </div>



                                @elseif(count($subscriptions) == 0)
                                    <div class="col-md-12">
                                        <strong>Next Step:</strong>
                                        <a href="{{ route('gym-admin.client-purchase.create') }}">
                                            Add Subscription

                                            <i class="fa fa-arrow-right"></i>
                                        </a>

                                    </div>

                                @elseif(count($payments) == 0)
                                    <div class="col-md-12">
                                        <strong>Next Step:</strong>
                                        <a href="{{ route('gym-admin.membership-payment.create') }}">
                                            Add Payment

                                            <i class="fa fa-arrow-right"></i>
                                        </a>

                                    </div>

                                @endif

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- Account setup progress end --}}
            @endif

            <div class="row">
                {!! Form::open(['route'=>'gym-admin.client.store','id'=>'clients_details','class'=>'ajax-form','method'=>'POST','files' => true]) !!}
                <div class="col-md-6">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption font-green">
                            <i class="icon-pin font-green"></i>
                            <span class="caption-subject bold uppercase"> Personal Details </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                            <div class="form-body">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <?php
                                        $name = explode(' ', $enquiry->customer_name);
                                    ?>
                                    <input type="text" class="form-control" value="{{ ucwords($name[0]) }}" id="first_name" name="first_name"  >
                                    <input type="hidden" id="img_name" name="img_name">
                                    <label for="form_control_1">First Name</label>
                                    <span class="help-block">Please enter clients first name.</span>
                                </div>
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" value="@if(isset($name[1])){{ $name[1] }}@endif" class="form-control" id="last_name" name="last_name">
                                    <label for="form_control_1">Last Name</label>
                                    <span class="help-block">Please enter clients last name.</span>
                                </div>

                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited" id="gender" name="gender">
                                        <option value="" ></option>
                                        <option
                                                @if($enquiry->sex == "Male")
                                                    selected
                                                @endif
                                                value="male" >Male</option>
                                        <option
                                                @if($enquiry->sex == "Female")
                                                    selected
                                                @endif
                                                value="female">Female</option>
                                    </select>
                                    <label for="form_control_1">Gender</label>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <div class="form-md-radios">
                                        <label>Marital Status</label>
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" value="yes" id="yes_radio" name="marital_status" class="md-radiobtn">
                                                <label for="yes_radio">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Married </label>
                                            </div>
                                            <div class="md-radio ">
                                                <input type="radio" value="no" id="no_radio" name="marital_status" class="md-radiobtn" >
                                                <label for="no_radio">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Unmarried </label>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="help-block"></span>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control form-control-inline input-small date-picker" placeholder="Date of Birth" size="16" type="text" readonly value="{{ $enquiry->dob->format('m/d/Y') }}" id="dob" name="dob" />
                                            <span class="help-block"> </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="anniversaryDiv">
                                        <div class="form-group">
                                            <input class="form-control form-control-inline input-small date-picker" placeholder="Anniversary" size="16" type="text" value="" id="anniversary" readonly name="anniversary" />
                                            <span class="help-block"> </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input ">
                                    <input type="number" class="form-control" value="{{ $enquiry->age }}" id="age" name="age">
                                    <label for="form_control_1">Age</label>
                                    <span class="help-block">Please enter clients age.</span>
                                </div>


                                <div class="fileinput fileinput-new hide" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img name="file" id="changeProfile" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                    <div>
                                        <button class="btn blue" rel="upload" onclick="forImage(this)" >Upload Image</button>

                                    </div>
                                </div>

                            </div>
                    </div>
                </div>
                <!-- END SAMPLE FORM PORTLET-->
            </div>
                <div class="col-md-6">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-green">
                                <i class="icon-pin font-green"></i>
                                <span class="caption-subject bold uppercase"> Contact Details</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                                <div class="form-body">

                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" value="{{ $enquiry->email }}" class="form-control" id="email" name="email">
                                        <label for="form_control_1">Email</label>
                                        <span class="help-block">Please enter clients email.</span>
                                    </div>

                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="number" value="{{ $enquiry->mobile }}" class="form-control" id="mobile" name="mobile">
                                        <label for="form_control_1">Phone</label>
                                        <span class="help-block">Please enter clients phone number.</span>
                                    </div>

                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <textarea class="form-control" rows="3" name="address" id="address">{{ $enquiry->address }}</textarea>
                                        <label for="form_control_1">Address</label>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label>Height</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input ">
                                                <input type="number" value="{{ $enquiry->height_feet }}" class="form-control" id="height_feet" name="height_feet" placeholder="feet">
                                                <span class="help-block">Enter feet.</span>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input ">
                                                <input type="number" class="form-control" value="{{ $enquiry->height_inches }}" id="height_inches" name="height_inches" placeholder="inches">
                                                <span class="help-block">Enter inches.</span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="number" class="form-control" value="{{ $enquiry->weight }}" id="weight" name="weight">
                                        <label for="form_control_1">Weight</label>
                                        <span class="help-block">Please enter client's weight.</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <select class="form-control edited" id="source" name="source">
                                            <option value="" selected></option>
                                            <option value="huntplex" >Huntplex</option>
                                            <option value="direct">Direct</option>
                                        </select>
                                        <label for="form_control_1">Select Source</label>
                                    </div>

                                </div>

                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
                {!! Form::close() !!}
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="row">
                            <div class="col-md-offset-5 col-md-1">

                                <button type="button" class="btn blue mt-ladda-btn ladda-button" data-style="zoom-in" id="upload_clients">
                                                            <span class="ladda-label">
                                                                <i class="icon-arrow-up"></i>  Save</span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
        <!--Start For Upload Image-->
        <div class="modal fade" id="uploadImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="text-align: left">Upload Profile Image</h4>
                    </div>
                    <div id="imageUploadDiv">
                        <div class="modal-body">
                            <div id="choose">
                                <form method="post" role="form" enctype="multipart/form-data" class="avatar-form" action="{{ route('gym-admin.gymclient.uploadimage') }}">
                                    <input class="avatar-src" name="avatar_src" type="hidden">
                                    <input class="avatar-data" name="avatar_data" type="hidden">
                                    <input class="avatar-task" type="hidden" id="task">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                   <span style="left: 40%" class="btn green btn-file">
                           Browse <input type="file" name="file" id="image" class="avatar-input">

                       </span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End For Upload Image-->
        {{--!-- Cropping modal -->--}}
        <div class="modal" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">
                            <!-- Crop and preview -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="avatar-wrapper"></div>
                                </div>
                                <!--<div class="col-md-3">
                                    <div class="avatar-preview preview-lg"></div>
                                    <div class="avatar-preview preview-md"></div>
                                    <div class="avatar-preview preview-sm"></div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                        <button class="btn green avatar-save" onclick="formSubmit();">Save</button>
                    </div>

                </div>
            </div>
        </div><!-- /.modal -->

    </div>
@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
    {!! HTML::script('admin/pages/scripts/ui-buttons.min.js') !!}
    {!! HTML::script("front/js/cropper/crop-avatar.js?v=1.0")!!}
    {!! HTML::script("front/js/cropper/cropper.min.js?v=1.0")!!}
    <script>
            $('#dob').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true,
                endDate: '+0d',
                startView: 'decades'
            });
            $('#anniversary').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            });
            $('#joining_date').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true,
                endDate: '+0d'
            });
    </script>
    <script>
        $('#upload_clients').click(function(){
            $.easyAjax({
                url: '{{route('gym-admin.client.store')}}',
                container:'#clients_details',
                type: "POST",
                file: true,
                formReset:true
            })
        });
    </script>
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

        $('input[name=marital_status]').on('change',function () {
           var value = $('input[name=marital_status]:checked').val();
            if(value=='no')
            {
                $('#anniversaryDiv').css('display','none');
            }else {
                $('#anniversaryDiv').css('display','block');
            }
        });

        function forImage(task)
        {

            $('#task').val($(task).attr('rel'));
            $('#image').val('');
            if($('#task').val() == "upload")
            {
                $("#deleteProfileImage").hide();
            }
            else
            {
                $("#deleteProfileImage").removeAttr('style');
            }
            $('#uploadImage').modal('show');
        }


        function imageUpload(data,task) {
           // console.log(task);
            var obj = jQuery.parseJSON(data);
            if (task == "upload") {
                $(".profile-img-container_before").hide();
                $("#img_name").val(obj.image);
                $('.profile-img-container').removeAttr('style');
                $( ".profile-img-container" ).wrap( "<div class='imageDelete'></div>" );
                $('#uploadImage').modal('hide');
                $('#changeProfile').attr('src', "{{ asset('admin/uploads/gym_clients/img/master/') }}/" + obj.image);
                var data = '<div class="profile-big-container"> <img src="{{ asset('admin/uploads/gym_clients/img/master/') }}/' + obj.image + '" class="profile-img-big"><span rel="change" class="change-photo" onclick="forImage(this)">Change Photo</span></div>';
                $('.profile-img-container').find('a').attr('data-content', data).data('bs.popover').setContent();
                $('.changeAfterProfile').attr('src', "{{ asset('admin/uploads/gym_clients/img/thumb/') }}/" + obj.image);
                profile = '<img src="{{ asset('admin/uploads/gym_clients/img/thumb/') }}/' + obj.image + '">';
                $('.popover ').hide();
            }
            if (task == "change") {
                $('#uploadImage').modal('hide');
                $("#img_name").val(obj.image);
                $('#changeProfile').attr('src', "{{ asset('admin/uploads/gym_clients/img/master/') }}/" + obj.image);
                var data = '<div class="profile-big-container"> <img src="{{ asset('admin/uploads/gym_clients/img/master/') }}/' + obj.image + '" class="profile-img-big"><span rel="change" class="change-photo" onclick="forImage(this)">Change Photo</span></div>';
                $('.profile-img-container').find('a').attr('data-content', data).data('bs.popover').setContent();
                $('.changeAfterProfile').attr('src', "{{ asset('admin/uploads/gym_clients/img/thumb/') }}/" + obj.image);
                profile = '<img src="{{ asset('admin/uploads/gym_clients/img/thumb/') }}/' + obj.image + '">';
                $( ".profile-img-container" ).wrap( "<div class='imageDelete'></div>" );
                $('.popover ').hide();
            }

        }
    </script>


@stop