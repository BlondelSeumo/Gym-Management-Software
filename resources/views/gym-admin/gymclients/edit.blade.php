@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('css/cropper.css')!!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/datepicker.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
    {!! HTML::style('admin/pages/css/profile.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/datatables.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
    <style>
        .error-msg {
            color: red;
            display: none;
        }
    </style>
@stop

@section('content')
    <div class="container-fluid">
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{ route('gym-admin.dashboard.index') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Clients</span>
            </li>
            <li>
                <span>Create</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PROFILE SIDEBAR -->
                    <div class="profile-sidebar">
                        <!-- PORTLET MAIN -->
                        <div class="portlet light profile-sidebar-portlet ">
                            <!-- SIDEBAR USERPIC -->
                            <div class="profile-userpic">
                                @if($client->image != '')
                                    @if($gymSettings->local_storage == 0)
                                        <img id="changeProfile" src="{{$profileHeaderPath.$client->image}}" class="img-responsive image-change-profile" />
                                    @else
                                        <img id="changeProfile" src="{{asset('/uploads/profile_pic/master/').'/'.$client->image}}" class="img-responsive image-change-profile" />
                                    @endif
                                @else
                                    <img src="{{asset('/fitsigma/images/').'/'.'user.svg'}}" class="img-responsive image-change-profile" alt="">
                                @endif
                            </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name"> {{$client->first_name}} {{$client->last_name}} </div>
                            </div>
                            <!-- END SIDEBAR USER TITLE -->
                            <!-- SIDEBAR BUTTONS -->
                            <!-- END SIDEBAR BUTTONS -->
                            <!-- SIDEBAR MENU -->

                            <!-- END MENU -->
                        </div>
                        <!-- END PORTLET MAIN -->
                        <!-- PORTLET MAIN -->
                        <div class="portlet light ">
                            <!-- STAT -->
                            <div class="row list-separated profile-stat">
                                <div class="col-xs-12">
                                <div class="col-md-4 col-sm-3 col-xs-6">
                                    <div class="uppercase profile-stat-title"> {{ ($client->weight != '')? $client->weight: '-' }} </div>
                                    <div class="uppercase profile-stat-text"> Weight </div>
                                </div>
                                <div class="col-md-2 col-sm-3 col-xs-6">
                                    <div class="uppercase profile-stat-title">{{ $age }}</div>
                                    <div class="uppercase profile-stat-text"> Age </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="uppercase profile-stat-title"> {{$client->gender}} </div>
                                    <div class="uppercase profile-stat-text"> Gender </div>
                                </div>
                                </div>
                            </div>

                            <!-- END STAT -->
                            <div>
                                <div class="margin-top-20 profile-desc-link">
                                    <i class="fa fa-envelope"></i>
                                    <a href="javascript:;">{{$client->email}}</a>
                                </div>
                                <div class="margin-top-20 profile-desc-link">
                                    <i class="fa fa-phone"></i>
                                    <a href="javascript:;">{{$client->mobile}}</a>
                                </div>
                                {{--<div class="margin-top-20 profile-desc-link">--}}
                                    {{--<i class="fa fa-lock"></i>--}}
                                    {{--<a href="javascript:;">Biometric ID - {{ sprintf("%09d", $client->id) }}</a>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                        <!-- END PORTLET MAIN -->
                    </div>
                    <!-- END BEGIN PROFILE SIDEBAR -->
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light ">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" class="" data-toggle="tab">Change Avatar</a>
                                            </li>
                                            <li class="hidden-xs">
                                                <a href="#tab_1_3" data-toggle="tab">Memberships</a>
                                            </li>
                                            <li class="hidden-xs">
                                                <a href="#tab_1_4" data-toggle="tab">Payments</a>
                                            </li>
                                            <li class="dropdown visible-xs">
                                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-chevron-down  font-green"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right" role="menu">
                                                    <li>
                                                        <a href="#tab_1_3" data-toggle="tab">Memberships</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_4" data-toggle="tab">Payments</a>
                                                    </li>
                                                </ul>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <!-- PERSONAL INFO TAB -->
                                            <div class="tab-pane active" id="tab_1_1">
                                                {!! Form::open(['id'=>'personal_details','class'=>'ajax-form','method'=>'POST']) !!}
                                                <input type="hidden" name="id" value="{{$client->id}}">
                                                <input type="hidden" name="type" value="general">

                                                    <div class="row">
                                                        <div class="col-md-6 form-group">
                                                            <label>First Name</label>
                                                            <input type="text" placeholder="First Name" class="form-control" name="first_name" id="first_name" value="{{$client->first_name}}" />
                                                            <span class="help-block"></span>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label>Last Name</label>
                                                            <input type="text" placeholder="Last Name" class="form-control" name="last_name" id="last_name" value="{{$client->last_name}}" />
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-6 form-group">
                                                            <label>Mobile Number</label>
                                                            <input type="tel" placeholder="Mobile Number" name="mobile" id="mobile" class="form-control" value="{{$client->mobile}}"/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label>Email</label>
                                                            <input type="email" placeholder="Email" name="email" id="email" class="form-control" value="{{$client->email}}"/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-6 form-group">
                                                            <label>Address</label>
                                                            <textarea class="form-control" name="address" id="address" rows="6">{{$client->address}}</textarea>
                                                            <span class="help-block"></span>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <div class="form-group form-md-line-input">
                                                                <div class="form/group form-md-radios">
                                                                    <label>Marital Status</label>
                                                                    <div class="md-radio-inline">
                                                                        <div class="md-radio">
                                                                            <input type="radio" value="yes" id="yes_radio" name="marital_status" class="md-radiobtn" @if($client->marital_status == 'yes') checked @endif>
                                                                            <label for="yes_radio">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Married </label>
                                                                        </div>
                                                                        <div class="md-radio ">
                                                                            <input type="radio" value="no" id="no_radio" name="marital_status" class="md-radiobtn" @if($client->marital_status == 'no') checked @endif>
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
                                                                <div class="col-xs-12">
                                                                    <label>Height</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input ">
                                                                        <input type="number" min="0" class="form-control" id="height_feet" name="height_feet" placeholder="feet" value="{{ $client->height_feet }}">
                                                                        <label for="">Feet</label>
                                                                        <span class="help-block">Enter feet.</span>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input ">
                                                                        <input type="number" min="0" class="form-control" id="height_inches" name="height_inches" placeholder="inches" value="{{ $client->height_inches }}">
                                                                        <label for="">Inches</label>
                                                                        <span class="help-block">Enter inches.</span>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-6 form-group">
                                                            <label>Age</label>
                                                            <input type="number" placeholder="Age" class="form-control" name="age" value="{{ $age }}" id="age" readonly/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label>Weight</label>
                                                            <input type="number" min="0" placeholder="Weight" class="form-control" name="weight" id="weight" value="{{$client->weight}}" />
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-6 form-group">
                                                            <label>Gender</label>
                                                            <select class="form-control edited" id="gender" name="gender">
                                                                <option value="" selected></option>
                                                                <option value="male" @if($client->gender == 'male')selected @endif >Male</option>
                                                                <option value="female" @if($client->gender == 'female')selected @endif>Female</option>
                                                            </select>
                                                            <span class="help-block"></span>
                                                        </div>

                                                    </div>



                                                    <div class="row">
                                                        <div class="col-md-6 form-group">
                                                            <label>Date of Birth</label>
                                                            <input readonly class="form-control form-control-inline input-medium date-picker" placeholder="Date of Birth" size="16" type="text" @if(!is_null($client) && isset($client->dob)) value="{{ $client->dob->format('m/d/Y') }}" @endif id="dob" name="dob" />
                                                            <span class="help-block"></span>
                                                        </div>
                                                        <div class="col-md-6 form-group" id="anniversaryDiv">
                                                            <label>Anniversary</label>

                                                            <input readonly class="form-control form-control-inline input-medium date-picker" placeholder="Anniversary" size="16" type="text" value="@if(!is_null($client->anniversary)){{$client->anniversary->format('m/d/Y')}}@endif" id="anniversary" name="anniversary" />
                                                            <span class="help-block"></span>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 form-group">
                                                            <label>Password</label>
                                                            <input type="password" placeholder="Leave it blank to keep current password" name="password" class="form-control"/>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>

                                                    <div class="margiv-top-10">
                                                        <a href="javascript:;" class="btn green" id="save_personal"> Save Changes </a>
                                                        <a href="{{ URL::previous()}}" class="btn default"> Cancel </a>
                                                    </div>
                                                {!! Form::close() !!}
                                            </div>
                                            <!-- END PERSONAL INFO TAB -->
                                            <!-- CHANGE AVATAR TAB -->
                                            <div class="tab-pane" id="tab_1_2">
                                                <p> Change Image of Client </p>
                                                {!! Form::open(['id'=>'update_image','class'=>'ajax-form','method'=>'POST']) !!}
                                                    <div class="form-group">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                @if($client->image == '')
                                                                    <img id="changeMainProfile" src="{{asset('/fitsigma/images/').'/'.'user.svg'}}" alt="" />
                                                                @else
                                                                    @if($gymSettings->local_storage == 0)
                                                                        <img id="changeMainProfile" src="{{$profileHeaderPath.$client->image}}" alt="" />
                                                                    @else
                                                                        <img id="changeMainProfile" src="{{asset('/uploads/profile_pic/master/').'/'.$client->image}}" alt="" />
                                                                    @endif
                                                                @endif
                                                            </div>

                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                            <div>
                                                                <button class="btn blue" rel="upload" onclick="forImage(this)" >Upload Image</button>
                                                                <button class="btn blue" id="use-webcam"><i class="icon-camera"></i> Use Webcam</button>

                                                                <input type="hidden" name="id" value="{{$client->id}}">
                                                                <input type="hidden" name="type" value="file">
                                                                <input type="hidden" name="img_name" id="img_name">
                                                            </div>
                                                            <div id="error-msg" class="error-msg"></div>
                                                        </div>

                                                    </div>
                                                    <div class="margin-top-10">
                                                        {{--<a href="javascript:;" class="btn green" id="save_image"> Submit </a>--}}
                                                    </div>
                                               {!! Form::close() !!}
                                            </div>
                                            <!-- END CHANGE AVATAR TAB -->
                                            <!-- Membership TAB -->
                                            <div class="tab-pane" id="tab_1_3">
                                                <div class="portlet light form-fit ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="icon-badge font-red"></i>
                                                            <span class="caption-subject font-red sbold uppercase">User Memberships</span>
                                                        </div>
                                                        <div class="actions">
                                                            <div class="btn-group">
                                                                <a id="sample_editable_1_new" href="{{route('gym-admin.client-purchase.user-create', $client->id)}}" class="btn sbold dark"> Add New
                                                                    <i class="fa fa-plus"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="col-md-12 col-xs-12">
                                                                    <div class="portlet-body">
                                                                        <div class="mt-element-list">
                                                                            <div class="mt-list-head list-news ext-1 font-white bg-dark">
                                                                                <div class="list-head-title-container">
                                                                                    <h3 class="list-title">{{ ucwords('memberships') }}</h3>
                                                                                </div>
                                                                                <div class="list-count pull-right bg-red">{{ count($memberships) }}</div>
                                                                            </div>
                                                                            <div class="mt-list-container list-simple col-xs-12">
                                                                                <ul class="col-xs-12">
                                                                                    @foreach($memberships as $mem)
                                                                                        <li class="mt-list-item col-xs-12" id="mem-{{ $mem['id'] }}">
                                                                                            <div class="row">
                                                                                                <div class="col-xs-12 col-md-3 list-item-content">
                                                                                                    {{ ucwords($mem['title']) }}
                                                                                                </div>
                                                                                                <div class="col-xs-12 col-md-3">
                                                                                                    <i class="fa {{ $gymSettings->currency->symbol }}"></i>{{ $mem['price'] }}
                                                                                                </div>
                                                                                                <div class="col-xs-6 col-md-2">
                                                                                                    @if($mem['status'] == "active")
                                                                                                        <span class="label label-success uppercase"> {{ $mem['status'] }} </span>
                                                                                                    @else
                                                                                                        <span class="label label-danger uppercase"> {{ $mem['status'] }} </span>
                                                                                                    @endif
                                                                                                </div>
                                                                                                <div class="col-xs-6 col-md-2">
                                                                                                    <span class="label label-info uppercase"> {{ $mem['name'] }} </span>
                                                                                                </div>
                                                                                                <div class="col-xs-12 col-md-2">
                                                                                                    <span class="visible-xs sbold col-xs-6 no-padding">Start Date:</span> {{ $mem['start_date'] }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                &nbsp;
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END Membership TAB -->
                                            {{--Clients Payments--}}
                                            <div class="tab-pane" id="tab_1_4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                        <div class="portlet light ">
                                                            <div class="portlet-title">
                                                                <div class="caption font-dark">
                                                                    <i class=" fa {{ $gymSettings->currency->symbol }} font-red"></i>
                                                                    <span class="caption-subject font-red bold uppercase"> Payments</span>
                                                                </div>
                                                            </div>
                                                            <div class="portlet-body">
                                                                <table class="table table-striped table-bordered table-hover table-checkable order-column table-100" id="mem-payments">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="max-desktop"> Amount </th>
                                                                        <th class="desktop"> Payment For</th>
                                                                        <th class="desktop"> Source </th>
                                                                        <th class="desktop"> Payment Date </th>
                                                                        <th class="desktop"> Payment ID </th>
                                                                        <th class="desktop"> Actions </th>
                                                                    </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- END EXAMPLE TABLE PORTLET-->
                                                    </div>
                                                </div>
                                            </div>
                                            {{--Clients Payments --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE CONTENT -->
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>

    <div class="modal fade bs-modal-md in" id="receiptModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!--Start Image Upload-->
    <div class="modal fade" id="uploadImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="text-align: left">Upload Profile Image</h4>
                </div>
                <div id="imageUploadDiv" class="text-center">
                    <div class="uploadMsg"></div>
                    <div class="modal-body">
                        <div id="choose" class="margin-bottom-10 margin-top-10">
                            <form method="post" id="imageUploadForm" role="form" enctype="multipart/form-data" class="avatar-form">
                                <input class="avatar-task" type="hidden" id="task">
                                <input type="hidden" name="xCoordOne" id="xCoordOne">
                                <input type="hidden" name="yCoordOne" id="yCoordOne">
                                <input type="hidden" name="profileImageWidth" id="profileImageWidth">
                                <input type="hidden" name="profileImageHeight" id="profileImageHeight">

                                <span class="btn green btn-file ">
                           Browse <input type="file" name="file" id="image" class="avatar-input" onchange="readImageURL(this)">
                            </span>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End For Upload Image-->

    <!--Start Image Crop Modal-->
    <div class="modal fade" id="cropImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="text-align: left">Upload Profile Image</h4>
                </div>
                <div id="imageUploadDiv">
                    <div class="uploadMsg"></div>
                    <div class="modal-body">
                        <div id="choose">
                            <img id="croppedImage" height="300px">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn red" data-dismiss="modal">CLOSE</button>
                        <button type="button" class="btn green" id="advertImageCropButton">UPLOAD</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End For Image Crop Modal-->

    {{--webcam modal--}}
    <div class="modal" id="webcam-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title">Webcam</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="my_camera"></div>
                        <div id="my_webcam_result"></div>

                        <div class="col-md-12 text-center margin-top-15">
                            <button class="btn blue" id="capture-image"><i class="icon-camera"></i> Take Picture</button>
                            <button class="btn red" id="recapture-image"><i class="icon-refresh"></i> Retake Picture</button>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn green" disabled id="save-webcam-image">Done</button>
                    <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                </div>

            </div>
        </div>
    </div><!-- /.modal -->

@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/moment.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
    {!! HTML::script('admin/pages/scripts/components-date-time-pickers.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
    {!! HTML::script('admin/pages/scripts/ui-buttons.min.js') !!}
    {!! HTML::script('admin/pages/scripts/profile.min.js') !!}
    {!! HTML::script('admin/global/scripts/datatable.js') !!}
    {!! HTML::script('admin/pages/scripts/table-datatables-managed.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/datatables.min.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') !!}
    {!! HTML::script('js/cropper.js') !!}
    {!! HTML::script('admin/webcam/webcam.js') !!}


    <script>
        $('#dob').change(function () {
            var lre = /^\s*/;

            var inputDate = document.getElementById('dob').value;
            inputDate = inputDate.replace(lre, "");

            age=get_age(new Date(inputDate));

            $('#age').val(age);
            $('.age').text(age);
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

        $('#save_personal').click(function(){
            $.easyAjax({
                url: '{{route('gym-admin.client.update')}}',
                container:'#personal_details',
                type: "POST",
                data:$('#personal_details').serialize()
            })
        });
        $('#save_others').click(function(){
            $.easyAjax({
                url: '{{route('gym-admin.client.update')}}',
                container:'#other_details',
                type: "POST",
                data:$('#other_details').serialize()
            })
        });
        $('#save_image').click(function(){
            $.easyAjax({
                url: '{{route('gym-admin.client.update')}}',
                container:'#update_image',
                type: "POST",
                file:true
            })
        });

        $('input[name=marital_status]').on('change',function () {
            var value = $('input[name=marital_status]:checked').val();
            if(value=='no')
            {
                $('#anniversaryDiv').css('display','none');
            }else {
                $('#anniversaryDiv').css('display','block');
            }
        });
    </script>
    <script>
        var table = $('#mem-payments');
        // begin first table
        table.dataTable({
            responsive: true,
            "sAjaxSource": "{{ route('gym-admin.client.ajax-payments',$client->id) }}",
            bDestroy:true,
            "aoColumns": [
                { 'sClass': 'center', "bSortable": true  },
                { 'sClass': 'center', "bSortable": true  },
                { 'sClass': 'center', "bSortable": true  },
                { 'sClass': 'center', "bSortable": true  },
                { 'sClass': 'center', "bSortable": true  },
                { 'sClass': 'center', "bSortable": false  }
            ],
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ records",
                "infoEmpty": "No records found",
                "infoFiltered": "(filtered1 from _MAX_ total records)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching records found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },
            "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number"
        });
    </script>
    <script>
        $('#mem-payments').on('click','.remove-payment',function(){
            var id = $(this).data('payment-id');
            bootbox.confirm({
                message: "Do you want to delete this payment?",
                buttons: {
                    confirm: {
                        label: "Yes",
                        className: "btn-primary"
                    }
                },
                callback: function(result){
                    if(result){

                        var url = '{{route('gym-admin.membership-payment.destroy',':id')}}';
                        url = url.replace(':id',id);

                        $.easyAjax({
                            url: url,
                            type: "DELETE",
                            data: {id: id,_token: '{{ csrf_token() }}'},
                            success: function(){
                                load_dataTable();
                            }
                        });
                    }
                    else {
                        console.log('cancel');
                    }
                }
            })
        });


        $('#mem-payments').on('click','.view-receipt', function () {
            var paymentId = $(this).data('payment-id');
            var show_url = '{{route('gym-admin.membership-payment.view-receipt',['#paymentId'])}}';
            var url = show_url.replace('#paymentId', paymentId);
            $('#modelHeading').html('Select Time');
            $.ajaxModal("#receiptModal", url);
        });

        $('#mem-payments').on('click','.email-receipt', function () {
            var paymentId = $(this).data('payment-id');
            var url_update = '{{route('gym-admin.membership-payment.email-receipt',[':id'])}}';
            var url = url_update.replace(':id',paymentId);
            $.easyAjax({
                url: url,
                type: 'GET',
                data: {paymentId: paymentId },
                success: function(response){
                    $('#payment_for_area').html(response.data);
                }
            })
        });
    </script>

    <script>
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
      function readImageURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#choose > img').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
        $('#cropImage').modal('show');
        $('#uploadImage').modal('hide');
      }
      $(document).ready(function() {
        $('#cropImage').on('shown.bs.modal', function () {
          $('#choose > img').cropper({
            autoCropArea: 0.8,
            viewMode: 2,
            aspectRatio: 4/3,
            dragMode: 'move',
            guides: true,
            highlight: true,
            dragCrop: true,
            cropBoxMovable: true,
            cropBoxResizable: true,
            mouseWheelZoom: true,
            touchDragZoom: false,
            rotatable: false,
            checkOrientation: false,
            crop: function(e) {
              var imageDataCrops = $(this).cropper('getImageData');
              $('#xCoordOne').val(e.x);
              $('#yCoordOne').val(e.y);
              $('#profileImageWidth').val(e.width);
              $('#profileImageHeight').val(e.height);
            },
            cropmove: function (e) {
              var cropBoxData = $(this).cropper('getCropBoxData');
              var cropBoxWidth = cropBoxData.width;
              var cropBoxHeight = cropBoxData.height;
              if (cropBoxWidth < 208) {
                $(this).cropper('setCropBoxData', {
                  width: 200
                });
              }
              if (cropBoxHeight < 208) {
                $(this).cropper('setCropBoxData', {
                  height: 200
                });
              }
            }
          });
        }).on('hidden.bs.modal', function () {
          advertCropBoxData = $('#choose > img').cropper('getCropBoxData');
          advertCanvasData = $('#choose > img').cropper('getCanvasData');
          $('#choose > img').cropper('destroy');
        });
        $("#advertImageCropButton").click(function () {
          uploadImage();
          $('#cropImage').modal('hide');
        });
      });

      function uploadImage() {
        var id = "{{ $client->id }}";
        var image = $('#image')[0];
        var xCoordinate = $('#xCoordOne').val();
        var yCoordinate = $('#yCoordOne').val();
        var profileImageWidth = $('#profileImageWidth').val();
        var profileImageHeight = $('#profileImageHeight').val();
        var formData = new FormData();
        formData.append('id', id);
        formData.append('xCoordOne', xCoordinate);
        formData.append('yCoordOne', yCoordinate);
        formData.append('profileImageWidth', profileImageWidth);
        formData.append('profileImageHeight', profileImageHeight);
        formData.append('file', image.files[0]);
        $.ajax({
          type: 'post',
          url: "{{ route('gym-admin.gymclient.uploadimage') }}",
          cache: false,
          processData: false,
          contentType: false,
          data: formData
        }).done(
          function( response ) {
              var obj = jQuery.parseJSON( response );
              $('#uploadImage').modal('hide');
              @if($gymSettings->local_storage == '0')
                  $('#changeProfile').attr('src', "{{ $profileHeaderPath }}" + obj.image);
                  $('#changeMainProfile').attr('src', "{{ $profileHeaderPath }}" + obj.image);
              @else
                  $('#changeProfile').attr('src', "{{ asset('/uploads/profile_pic/master/') }}"+ '/' + obj.image);
                  $('#changeMainProfile').attr('src', "{{ asset('/uploads/profile_pic/master/') }}"+ '/' + obj.image);
              @endif
              $('.popover ').hide();
          });
      }
    </script>

    <script>
        $('document').ready(function () {
            var value = $('input[name=marital_status]:checked').val();
            if(value=='no')
            {
                $('#anniversaryDiv').css('display','none');
            }
        });
    </script>


    <script>
        $('#use-webcam').click(function () {
            Webcam.set({
                width: 640,
                height: 480,
                dest_width: 640,
                dest_height: 480,
                image_format: 'jpeg',
                jpeg_quality: 100,
                flip_horiz: true,
                force_flash: false
            });
            Webcam.attach( '#my_camera' );

            $('#recapture-image').hide();
            $('#my_webcam_result').hide();
            $('#my_camera').show();
            $('#webcam-modal').modal('show');
            $('#capture-image').show();
            $('#save-webcam-image').attr('disabled', 'disabled');

        });

        $('#capture-image').click(function () {
            Webcam.snap( function(data_uri) {
                $('#my_camera').hide();
                document.getElementById('my_webcam_result').innerHTML = '<img src="'+data_uri+'"/>';
            } );
            $('#my_webcam_result').fadeIn();
            $('#capture-image').hide();
            $('#recapture-image').show();
            $('#save-webcam-image').removeAttr('disabled');
        });

        $('#recapture-image').click(function () {
            $('#recapture-image').hide();
            $('#my_camera').show();
            $('#my_webcam_result').hide();
            $('#capture-image').show();
            $('#save-webcam-image').attr('disabled', 'disabled');
        });

        $('#webcam-modal').on('hidden.bs.modal', function () {
            Webcam.reset();
        });


        $('#save-webcam-image').click(function () {
            var data_uri = $('#my_webcam_result img').attr('src');
            Webcam.on( 'uploadProgress', function(progress) {
                // Upload in progress
                // 'progress' will be between 0.0 and 1.0
            } );

            Webcam.on( 'uploadComplete', function(code, res) {
                var obj = jQuery.parseJSON(res);
                $('#webcam-modal').modal('hide');
                $("#img_name").val(res);
                @if($gymSettings->local_storage == 0)
                    $('#changeProfile').attr('src', "{{ $profileHeaderPath }}" + obj.image);
                    $('#changeMainProfile').attr('src', "{{ $profileHeaderPath }}" + obj.image);
                @else
                    $('#changeProfile').attr('src', "{{ asset('/uploads/profile_pic/master/') }}"+ '/' + obj.image);
                    $('#changeMainProfile').attr('src', "{{ asset('/uploads/profile_pic/master/') }}"+ '/' + obj.image);
                @endif
            } );

            var uploadUrl = '{{ route("gym-admin.client.save-webcam-image", [ $client->id ]) }}';

            Webcam.upload( data_uri, uploadUrl,null, '{{ csrf_token() }}');
        });

    </script>


@stop