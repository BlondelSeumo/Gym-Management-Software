@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('css/cropper.css')!!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/datepicker.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}


    {!! HTML::style('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
    <style>
        .error-msg {
            color: red;
            display: none;
        }
    </style>
@stop

@section('content')
    <div class="container-fluid"      >

        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{route('gym-admin.dashboard.index')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Profile</span>
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
								<span class="caption-subject font-white">
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
                <div class="col-md-8">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-user font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> profile</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            {!! Form::open(['route'=>'gym-admin.profile.store','id'=>'profileUpdateForm','class'=>'ajax-form form-horizontal','method'=>'POST','files' => true]) !!}
                                <div class="form-body">
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">First Name</label>
                                        <div class="col-md-6 input-icon right">
                                            <input type="text" class="form-control" placeholder="First Name" name="first_name" id="fisrt_name" value="{{$user->first_name}}">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Enter your first name</span>
                                            <i class="icon-user"></i>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">Last Name</label>
                                        <div class="col-md-6 input-icon right">
                                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" value="{{$user->last_name}}">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Enter your last name</span>
                                            <i class="icon-user"></i>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-radios">
                                        <label class="col-md-2 control-label" for="form_control_1">Gender</label>
                                        <div class="col-md-6">
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio" id="male" name="gender" value="male" class="md-radiobtn" @if($user->gender == 'male') checked="checked" @endif>
                                                    <label for="male">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Male </label>
                                                </div>
                                                <div class="md-radio">
                                                    <input type="radio" id="female" name="gender" value="female" class="md-radiobtn" @if($user->gender == 'female')checked="checked" @endif>
                                                    <label for="female">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Female </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">Mobile</label>
                                        <div class="col-md-6 input-icon right">
                                            <input type="tel" class="form-control" placeholder="Mobile number" id="mobile" name="mobile" value="{{$user->mobile}}">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Your mobile number</span>
                                            <i class="fa fa-mobile"></i>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">Email</label>
                                        <div class="col-md-6 input-icon right">
                                            <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{$user->email}}">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Your email address</span>
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">Date of Birth</label>
                                        <div class="col-md-6 input-icon right">
                                            <input readonly name="date_of_birth" id="date_of_birth" type="text"  class="form-control  date-picker" data-date-format="yyyy-mm-dd"  placeholder="Date of birth" value="@if(!is_null($user->date_of_birth)){{ \Carbon\Carbon::createFromFormat('Y-m-d', $user->date_of_birth)->format('Y-m-d')}}@endif">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Enter your date of birth</span>
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input ">
                                        <label class="col-md-2 control-label" for="form_control_1"> Username</label>
                                        <div class="col-md-6 input-icon right">
                                            <input type="text" name="username" class="form-control" placeholder="Username" value="{{$user->username}}">

                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input hidden-sm hidden-xs">
                                        <label class="col-md-2 control-label" for="form_control_1">Profile Image</label>
                                        <div class="col-md-4">
                                            <div class="input-icon right">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                        @if($user->image == '')
                                                            <img id="changeProfile" src="{{asset('/fitsigma/images/').'/'.'user.svg'}}" alt="" />
                                                        @else
                                                            @if($gymSettings->local_storage == '0')
                                                                <img id="changeProfile" src="{{$profileHeaderPath.$user->image}}" alt="" />
                                                            @else
                                                                <img id="changeProfile" src="{{asset('/uploads/profile_pic/master/').'/'.$user->image}}" alt="" />
                                                            @endif
                                                        @endif
                                                         </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>

                                                </div>

                                                @if($user->image == "")
                                                    <button class="btn blue" rel="upload" onclick="forImage(this)" >Upload Image</button>
                                                @else
                                                    <button class="btn blue" rel="change" onclick="forImage(this)" >Change Image</button>
                                                @endif
                                            </div>
                                            <div id="error-msg" class="error-msg"></div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input has-success input-icon right ">

                                    </div>

                                    <div class="form-group form-md-line-input ">
                                        <label class="col-md-2 control-label" for="form_control_1">Password</label>
                                        <div class="col-md-6 input-icon right">
                                            <input type="password" class="form-control" placeholder="Leave blank to keep current password" id="password" name="password">
                                            <span class="help-block">Leave Blank to keep current password </span>
                                            <i class="fa fa-key"></i>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            <input type="hidden" name="id" value="{{$user->id}}">
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <a href="javascript:;" class="btn green" id="updateProfile">Submit</a>
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
    {!! HTML::script('admin/pages/scripts/components-date-time-pickers.min.js') !!}
    {!! HTML::script('js/cropper.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
<script>
$('#updateProfile').click(function(){
    $.easyAjax({
        url: '{{route('gym-admin.profile.store')}}',
        container:'#profileUpdateForm',
        type: "POST",
        data:$('#profileUpdateForm').serialize(),
        file: true,
        success: function (response) {
            if (response.status == "success") {
                window.location.reload();
            }
        }

    });
});
</script>
    <script>
        $('#date_of_birth').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true,
            endDate:'0d+'
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
          data: formData,
            success: function(response) {
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
                $('#changeProfile').attr('src', "{{ asset('/uploads/profile_pic/master/') }}"+ '/' + obj.image);
                var data = '<div class="profile-big-container"> <img src="{{ asset('/uploads/profile_pic/master/') }}'+ '/' + obj.image + '" class="profile-img-big"><span rel="change" class="change-photo" onclick="forImage(this)">Change Photo</span></div>';
                $('.changeAfterProfile').attr('src', "{{ asset('/uploads/profile_pic/thumb/') }}"+ '/' + obj.image);
                $('.img-change').attr('src', "{{ asset('/uploads/profile_pic/master/') }}"+ '/' + obj.image);
                profile = '<img src="{{ asset('/uploads/profile_pic/thumb/') }}'+ '/' + obj.image + '">';
                @endif
                $('.popover ').hide();
            },
            error: function(error) {
              var message = JSON.parse(error.responseText);
              $('#error-msg').show();
              $('#error-msg').text(message.errors.file[0]);
            }
        });
      }
    </script>
@stop