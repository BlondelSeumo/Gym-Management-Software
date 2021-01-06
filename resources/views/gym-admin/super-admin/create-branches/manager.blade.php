@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('css/cropper.css')!!}
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
                <span>Branch Setup 2 of 4</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-layers font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Branch setup wizard</span>
                            </div>
                            <div class="actions">
                                <span class="caption-subject font-red bold uppercase"> STEP 2 of 4 </span>
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

                            {!! Form::open(['route'=>'gym-admin.superadmin.store','id'=>'managerStoreForm','class'=>'ajax-form form-horizontal','method'=>'POST','files' => true]) !!}
                            <div class="form-wizard">
                                <div class="form-body">
                                    <ul class="nav nav-pills nav-justified steps">
                                        @if(isset($branch_id))
                                            <li>
                                                <a href="{{ route('gym-admin.superadmin.branch', [$branch_id]) }}" class="step">
                                                    <span class="number"> 1 </span>
                                                    <span class="desc">
                                                                            <i class="fa fa-check"></i> Add Branch </span>
                                                </a>
                                            </li>
                                        @endif
                                        <li class="active">
                                            <a href="javascript:;" class="step">
                                                <span class="number"> 2 </span>
                                                <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Manager </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"
                                               class="step active">
                                                <span class="number"> 3 </span>
                                                <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Role </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" class="step">
                                                <span class="number"> 4 </span>
                                                <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Permission </span>
                                            </a>
                                        </li>
                                    </ul>
                                    @if(!is_null($managerData))
                                        <input type="hidden" name="manager_id" value="{{ $managerData->id }}">
                                    @endif
                                    @if(isset($branch_id))
                                        <input type="hidden" name="branch_id" value="{{ $branch_id }}">
                                    @endif
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">First Name <span class="required" aria-required="true"> * </span></label>

                                        <div class="col-md-6 input-icon right">
                                            <input type="text" class="form-control" name="first_name" @if(!is_null($managerData)) value="{{ $managerData->first_name }}" @endif>

                                            <div class="form-control-focus"></div>
                                            <span class="help-block">Enter your first name</span>
                                            <i class="icon-user"></i>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">Last Name <span class="required" aria-required="true"> * </span></label>

                                        <div class="col-md-6 input-icon right">
                                            <input type="text" class="form-control" name="last_name" id="last_name" @if(!is_null($managerData)) value="{{ $managerData->last_name }}" @endif>

                                            <div class="form-control-focus"></div>
                                            <span class="help-block">Enter your last name</span>
                                            <i class="icon-user"></i>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">Email <span class="required" aria-required="true"> * </span></label>

                                        <div class="col-md-6 input-icon right">
                                            <input type="text" class="form-control" name="email" id="email" @if(!is_null($managerData)) value="{{ $managerData->email }}" @endif>

                                            <div class="form-control-focus"></div>
                                            <span class="help-block">Enter your email address</span>
                                            <i class="icon-user"></i>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-radios">
                                        <label class="col-md-2 control-label" for="form_control_1">Gender</label>

                                        <div class="col-md-6">
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio" id="male" name="gender" value="male"
                                                           class="md-radiobtn" @if(!is_null($managerData) && ($managerData->gender == 'male')) checked @endif>
                                                    <label for="male">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Male </label>
                                                </div>
                                                <div class="md-radio">
                                                    <input type="radio" id="female" name="gender" value="female"
                                                           class="md-radiobtn" @if(!is_null($managerData) && ($managerData->gender == 'female')) checked @endif>
                                                    <label for="female">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Female </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input mobile">
                                        <label class="col-md-2 control-label" for="form_control_1">Mobile <span class="required" aria-required="true"> * </span></label>

                                        <div class="col-md-6 input-icon right">
                                            <input type="tel" class="form-control" id="mobile" name="mobile" @if(!is_null($managerData) && isset($managerData->mobile)) value="{{ $managerData->mobile }}" @endif>

                                            <div class="form-control-focus"></div>
                                            <span class="help-block error-message">Your mobile number</span>
                                            <i class="fa fa-mobile"></i>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">Date of Birth</label>

                                        <div class="col-md-6 input-icon right">
                                            <input readonly name="date_of_birth" id="date_of_birth" type="text"
                                                   class="form-control  date-picker" data-date-format="yyyy-mm-dd" @if(!is_null($managerData) && isset($managerData->date_of_birth)) value="{{ $managerData->date_of_birth }}" @endif>

                                            <div class="form-control-focus"></div>
                                            <span class="help-block">Enter your date of birth</span>
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input ">
                                        <label class="col-md-2 control-label" for="form_control_1"> Username</label>

                                        <div class="col-md-6 input-icon right">
                                            <input type="text" class="form-control" name="username" @if(!is_null($managerData) && isset($managerData->username)) value="{{ $managerData->username }}" @endif>

                                            <span class="help-block">Enter Username</span>
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>


                                    <div class="form-group form-md-line-input hidden-xs hidden-sm">
                                        <label class="col-md-2 control-label" for="form_control_1">Profile Image</label>

                                        <div class="col-md-6">

                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail"
                                                     style="width: 200px; height: 150px;">
                                                    @if(!is_null($managerData) && $managerData->image == '')
                                                        <img id="changeProfile" src="{{asset('/fitsigma/images/').'/'.'user.svg'}}" alt="" />
                                                    @else
                                                        @if($gymSettings->local_storage == '0')
                                                            @if(!is_null($managerData))
                                                                <img id="changeProfile" src="{{$profileHeaderPath.$managerData->image}}" alt="" />
                                                            @endif
                                                        @else
                                                            @if(!is_null($managerData))
                                                                <img id="changeProfile" src="{{asset('/profile_pic/master/').'/'.$managerData->image}}" alt="" />
                                                            @endif
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"
                                                     style="max-width: 200px; max-height: 150px;"></div>

                                            </div>

                                            <div>
                                                <button class="btn blue" rel="upload" onclick="forImage(this)">
                                                    Upload Image
                                                </button>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="form-group form-md-line-input has-success input-icon right ">

                                    </div>
                                    <div class="form-group form-md-line-input ">
                                        <label class="col-md-2 control-label" for="form_control_1">Password</label>
                                        <div class="col-md-6 input-icon right">
                                            <input type="password" class="form-control" id="password" name="password">
                                            <span class="help-block">Enter password</span>
                                            <i class="fa fa-key"></i>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input ">
                                        <label class="col-md-2 control-label" for="form_control_1">Confirm Password</label>
                                        <div class="col-md-6 input-icon right">
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                            <span class="help-block">Enter confirm password</span>
                                            <i class="fa fa-key"></i>
                                        </div>
                                    </div>
                                    <hr>
                                </div>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <a href="javascript:;" class="btn green" id="storeManager">Submit</a>
                                        </div>
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

    </div>
@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
    {!! HTML::script('admin/pages/scripts/ui-buttons.min.js') !!}
    {!! HTML::script("js/cropper.js")!!}
    <script>
        $('#storeManager').click(function () {
            $.easyAjax({
                url: '{{ route('gym-admin.superadmin.storeManagerPage') }}',
                container: '#managerStoreForm',
                type: 'POST',
                data: $('#managerStoreForm').serialize(),
                file: true
            });
        });

        $('#date_of_birth').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true,
            endDate:'0d+'
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

            var image = $('#image')[0];
            var xCoordinate = $('#xCoordOne').val();
            var yCoordinate = $('#yCoordOne').val();
            var profileImageWidth = $('#profileImageWidth').val();
            var profileImageHeight = $('#profileImageHeight').val();
            var formData = new FormData();
            formData.append('xCoordOne', xCoordinate);
            formData.append('yCoordOne', yCoordinate);
            formData.append('profileImageWidth', profileImageWidth);
            formData.append('profileImageHeight', profileImageHeight);
            formData.append('file', image.files[0]);
            $.ajax({
                type: 'post',
                url: "{{ route('gym-admin.gym.uploadimage') }}",
                cache: false,
                processData: false,
                contentType: false,
                data: formData
            }).done(
                function( response ) {
                    var obj = jQuery.parseJSON( response );
                    $(".profile-img-container_before").hide();
                    $('.profile-img-container').removeAttr('style');
                    $( ".profile-img-container" ).wrap( "<div class='imageDelete'></div>" );
                    $('#uploadImage').modal('hide');
                    @if($gymSettings->local_storage == '0')
                    $('#changeProfile').attr('src', "{{ $profileHeaderPath }}" + obj.image);
                    var data = '<div class="profile-big-container"> <img src="{{ $profileHeaderPath }}' + obj.image + '" class="profile-img-big"><span rel="change" class="change-photo" onclick="forImage(this)">Change Photo</span></div>';
                    $('.changeAfterProfile').attr('src', "{{ $profilePath }}" + obj.image);
                    $('.img-change').attr('src', "{{ $profileHeaderPath }}" + obj.image);
                    profile = '<img src="{{ $profilePath }}' + obj.image + '">';
                    @else
                    $('#changeProfile').attr('src', "{{ asset('/profile_pic/master/') }}"+ '/' + obj.image);
                    var data = '<div class="profile-big-container"> <img src="{{ asset('/profile_pic/master/') }}'+ '/' + obj.image + '" class="profile-img-big"><span rel="change" class="change-photo" onclick="forImage(this)">Change Photo</span></div>';
                    $('.changeAfterProfile').attr('src', "{{ asset('/profile_pic/thumb/') }}"+ '/' + obj.image);
                    $('.img-change').attr('src', "{{ asset('/profile_pic/master/') }}"+ '/' + obj.image);
                    profile = '<img src="{{ asset('/profile_pic/thumb/') }}'+ '/' + obj.image + '">';
                    @endif
                    $('.popover ').hide();
                });
        }
    </script>
@stop