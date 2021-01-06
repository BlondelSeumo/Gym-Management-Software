@extends('layouts.customer-app.basic')

@section('title')
    Fitsigma | Customer Profile
@endsection

@section('CSS')
    {!! HTML::style('fitsigma_customer/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
    {!! HTML::style('css/cropper.css')!!}
    <style>
        .anniversary-display {
            display: none;
        }
        .padding-top-btn {
            padding-top: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">My Profile</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Main Menu</li>
                <li class="active">My Profile</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box p-l-20 p-r-20">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['route'=>'customer-app.profile.store','id'=>'profileForm','class'=>'form-material ajax-form','method'=>'POST','files' => true]) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">First Name</label>
                                        <input type="text" class="form-control" name="first_name" value="{{ $customerValues->first_name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" value="{{ $customerValues->last_name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Mobile</label>
                                        <input type="text" name="mobile" class="form-control form-control-line" value="{{ $customerValues->mobile }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="email" name="email" class="form-control form-control-line" value="{{ $customerValues->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Gender</label>
                                        <div class="radio-list">
                                            <label class="radio-inline p-0">
                                                <div class="radio radio-info">
                                                    <input type="radio" name="gender" id="radio1" value="male" @if($customerValues->gender == 'male') checked @endif>
                                                    <label>Male</label>
                                                </div>
                                            </label>
                                            <label class="radio-inline">
                                                <div class="radio radio-info">
                                                    <input type="radio" name="gender" id="radio2" value="female" @if($customerValues->gender == 'female') checked @endif>
                                                    <label>Female </label>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Date of Birth</label>
                                        <input type="text" class="form-control" id="datepicker-autoclose-dob" placeholder="mm/dd/yyyy" name="dob" value="@if(!is_null($customerValues->dob)){{ $customerValues->dob->format('m/d/Y') }}@endif">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Marital Status</label>
                                        <div class="radio-list">
                                            <label class="radio-inline p-0">
                                                <div class="radio radio-info">
                                                    <input type="radio" name="marital_status" id="radio1" value="yes" @if($customerValues->marital_status == 'yes') checked @endif>
                                                    <label>Married</label>
                                                </div>
                                            </label>
                                            <label class="radio-inline">
                                                <div class="radio radio-info">
                                                    <input type="radio" name="marital_status" id="radio2" value="no" @if($customerValues->marital_status == 'no') checked @endif>
                                                    <label>Unmarried</label>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 @if($customerValues->marital_status == 'no') anniversary-display @endif anniversary-div">
                                    <div class="form-group">
                                        <label class="control-label">Anniversary</label>
                                        <input type="text" class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy" name="anniversary" value="@if(!is_null($customerValues->anniversary)){{ $customerValues->anniversary->format('m/d/Y')}}@endif">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <label class="col-md-12">Height</label>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="number" min="0" class="form-control" id="height_feet" name="height_feet" placeholder="Feet" value="{{ $customerValues->height_feet }}">
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="number" min="0" class="form-control" id="height_inches" name="height_inches" placeholder="Inches" value="{{ $customerValues->height_inches }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Weight</label>
                                        <input type="text" name="weight" class="form-control form-control-line" value="{{ $customerValues->weight }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Address</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" rows="5" name="address">{{ $customerValues->address }}</textarea>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input hidden-sm hidden-xs">
                            <label class="col-md-2 control-label" for="form_control_1">Profile Image</label>
                            <div class="col-md-4">
                                <div class="input-icon right">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            @if($customerValues->image == '')
                                                <img id="changeProfile" src="{{asset('/fitsigma/images/').'/'.'user.svg'}}" alt="" />
                                            @else
                                                @if($gymSettings->local_storage == 0)
                                                    <img id="changeProfile" src="{{$profileHeaderPath.$customerValues->image}}" alt="" />
                                                @else
                                                    <img id="changeProfile" src="{{asset('/uploads/profile_pic/master/').'/'.$customerValues->image}}" alt="" />
                                                @endif
                                            @endif
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>

                                    </div>
                                </div>
                                <button class="btn btn-info" rel="upload" onclick="forImage(this)" >Upload Image</button>
                                <button class="btn btn-default" id="use-webcam"><i class="icon-camera"></i> Use Webcam</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <input type="text" name="password" class="form-control form-control-line" placeholder="Leave it blank to keep current password.">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary waves-effect" id="submit-btn">Submit</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
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

    {{--Start Webcam modal--}}
    <div class="modal" id="webcam-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title">Webcam</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="my_camera" class="text-center"></div>
                        <div id="my_webcam_result" class="text-center"></div>

                        <div class="col-md-12 text-center padding-top-btn">
                            <button class="btn btn-info" id="capture-image"><i class="icon-camera"></i> Take Picture</button>
                            <button class="btn btn-danger" id="recapture-image"><i class="icon-refresh"></i> Retake Picture</button>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" disabled id="save-webcam-image">Done</button>
                    <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                </div>

            </div>
        </div>
    </div>
    {{--End Webcam Modal--}}
@endsection

@section('JS')
    {!! HTML::script('fitsigma_customer/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
    {!! HTML::script('js/cropper.js') !!}
    {!! HTML::script('admin/webcam/webcam.js') !!}
    <script>
        $('#datepicker-autoclose, #datepicker-autoclose-dob').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('input[name=marital_status]').on('change',function () {
            var value = $('input[name=marital_status]:checked').val();
            if(value=='no')
            {
                $('.anniversary-div').css('display','none');
            }else {
                $('.anniversary-div').css('display','block');
            }
        });

        $('#submit-btn').click(function() {
            $.easyAjax({
                type: 'POST',
                url: '{{ route('customer-app.profile.store') }}',
                container: '#profileForm',
                data: $('#profileForm').serialize()
            });
        });

        function forImage(task) {
            $('#task').val($(task).attr('rel'));
            $('#image').val('');
            if($('#task').val() == "upload") {
                $("#deleteProfileImage").hide();
            } else {
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
                type: 'POST',
                url: "{{ route('customer-app.profile.upload-image') }}",
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
                    @if($gymSettings->local_storage == 0)
                        $('#changeProfile').attr('src', "{{ $profileHeaderPath }}" + obj.image);
                        $('.img-change').attr('src', "{{ $profileHeaderPath }}" + obj.image);
                    @else
                        $('#changeProfile').attr('src', "{{ asset('/uploads/profile_pic/master/') }}"+ '/' + obj.image);
                        $('.img-change').attr('src', "{{ asset('/uploads/profile_pic/master/') }}"+ '/' + obj.image);
                    @endif
                    $('.popover ').hide();
                }
            });
        }

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
                    $('.img-change').attr('src', "{{ $profileHeaderPath }}" + obj.image);
                @else
                    $('#changeProfile').attr('src', "{{ asset('/uploads/profile_pic/master/') }}"+ '/' + obj.image);
                    $('.img-change').attr('src', "{{ asset('/uploads/profile_pic/master/') }}"+ '/' + obj.image);
                @endif
            } );

            var uploadUrl = '{{ route("customer-app.profile.upload-webcam-image", [ $customerValues->id ]) }}';

            Webcam.upload( data_uri, uploadUrl,null, '{{ csrf_token() }}');
        });
    </script>
@endsection