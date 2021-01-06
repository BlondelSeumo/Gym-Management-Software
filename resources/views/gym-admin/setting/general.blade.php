@extends('gym-admin.setting.master-setting')

@push('general-styles')
    <style>
        .padding-bottom-btn {
            padding-bottom: 20px;
        }
    </style>
@endpush

@section('settingBody')
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <ul class="nav nav-tabs tabs-left">
                    <li class="active">
                        <a href="javascript:;"> General </a>
                    </li>
                    <li>
                        <a href="{{ route('gym-admin.setting.mail') }}"> Mail </a>
                    </li>
                    <li>
                        <a href="{{ route('gym-admin.setting.fileUpload') }}"> File Upload </a>
                    </li>
                    <li>
                        <a href="{{ route('gym-admin.setting.others') }}"> Others </a>
                    </li>
                    <li>
                        <a href="{{ route('gym-admin.setting.footer') }}"> Footer </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
                <div class="tab-content">
                    {!! Form::open(['route'=>'gym-admin.setting.store','id'=>'settingUpdateForm','class'=>'ajax-form form-horizontal','method'=>'POST','files' => true]) !!}
                        <div class="form-body col-md-6 col-md-offset-1">

                            <div class="form-group form-md-line-input hidden-xs hidden-sm">
                                <label class="control-label" for="form_control_1">Logo</label>
                                <div class="input-icon right">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            @if($merchantSetting == '')
                                                <img id="changeProfile" src="{{ asset('/fitsigma/images/').'/'.'fitsigma-logo-full-red.png' }}" alt="" />
                                            @elseif($merchantSetting->image == '')
                                                <img src="{{ asset('/fitsigma/images/').'/'.'fitsigma-logo-full-red.png' }}" alt="" />
                                            @else
                                                @if($gymSettings->local_storage == '0')
                                                    <img id="changeProfile" src="{{$gymSettingPath.$merchantSetting->image}}" alt="" />
                                                @else
                                                    <img id="changeProfile" src="{{asset('/uploads/gym_setting/master/').'/'.$merchantSetting->image}}" alt="" />
                                                @endif
                                            @endif
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                    </div>
                                    <div class="clear-fix"></div>
                                    <button class="btn blue" rel="upload" onclick="forImage(this)" >Upload Image</button>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input hidden-xs hidden-sm">
                                <label class="control-label" for="form_control_1">Login Page Image</label>
                                <div class="input-icon right">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            @if($merchantSetting == '')
                                                <img id="loginImage" src="{{ asset("admin/pages/img/login/bg1.jpg") }}" alt="" />
                                            @elseif($merchantSetting->front_image == '')
                                                <img src="{{ asset("admin/pages/img/login/bg1.jpg") }}" alt="" />
                                            @else
                                                @if($gymSettings->local_storage == '0')
                                                    <img id="loginImage" src="{{$gymSettingPath.$merchantSetting->front_image}}" alt="" />
                                                @else
                                                    <img id="loginImage" src="{{asset('/uploads/gym_setting/master/').'/'.$merchantSetting->front_image}}" alt="" />
                                                @endif
                                            @endif
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                    </div>
                                    <div class="clear-fix"></div>
                                    <button class="btn blue" rel="upload" onclick="forFrontImage(this)" >Upload Image</button>
                                </div>
                            </div>
                            <div class="form-group padding-bottom-btn">
                                <label class="label label-danger">NOTE:</label> Login Page Image resolution 1200 X 1080.
                            </div>

                            <div class="form-group form-md-line-input hidden-xs hidden-sm">
                                <label class="control-label" for="form_control_1">Customer Panel Logo</label>
                                <div class="input-icon right">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            @if($merchantSetting == '')
                                                <img id="customerImage" src="{{ asset('/fitsigma/images/').'/'.'fitsigma-logo-full-red.png' }}" alt="" />
                                            @elseif($merchantSetting->customer_logo == '')
                                                <img src="{{ asset('/fitsigma/images/').'/'.'fitsigma-logo-full-red.png' }}" alt="" />
                                            @else
                                                @if($gymSettings->local_storage == 0)
                                                    <img id="customerImage" src="{{$gymSettingPath.$merchantSetting->customer_logo}}" alt="" />
                                                @else
                                                    <img id="customerImage" src="{{asset('/uploads/gym_setting/master/').'/'.$merchantSetting->customer_logo}}" alt="" />
                                                @endif
                                            @endif
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                    </div>
                                    <div class="clear-fix"></div>
                                    <button class="btn blue" rel="upload" onclick="forCustomerImage(this)" >Upload Image</button>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <a href="javascript:;" class="btn green" id="settingUpdate">Submit</a>
                                <a href="javascript:;" class="btn default">Cancel</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
            </div>
            </div>
        </div>
    </div>
@stop

@push('general-scripts')
    {!! HTML::script('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
    {!! HTML::script('js/cropper.js') !!}
    <script>
        $('#settingUpdate').click(function(){
            $.easyAjax({
                url: '{{ route('gym-admin.setting.store') }}',
                container:'#settingUpdateForm',
                type: "POST",
                file: true
            });
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
        
        function forFrontImage(task) {
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
            $('#uploadFrontImage').modal('show');
        }

        function uploadLoginImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#choose > img').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
            var formData = new FormData();
            formData.append('file', input.files[0]);
            $.ajax({
                type: 'post',
                url: "{{ route('gym-admin.setting.frontImage') }}",
                cache: false,
                processData: false,
                contentType: false,
                data: formData
            }).done(
                function( response ) {
                    if(response.status == 'fail') {

                    }
                    var obj = jQuery.parseJSON( response );
                    $('#uploadFrontImage').modal('hide');
                    @if($gymSettings->local_storage == '0')
                        $('#loginImage').attr('src', "{{ $gymSettingPath }}" + obj.image);
                    @else
                        $('#loginImage').attr('src', "{{ asset('/uploads/gym_setting/master/') }}"+ '/' + obj.image);
                    @endif
                    $('.popover ').hide();
                });
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
                    dragMode: 'move',
                    guides: true,
                    highlight: true,
                    dragCrop: true,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    mouseWheelZoom: true,
                    touchDragZoom: false,
                    built: function () {

                        // Width and Height params are number types instead of string
                        $('#choose > img').cropper('setCropBoxData', {width: 800, height: 500});
                        var $clone = $(this).clone();
                        $clone.css({
                            display: 'block',
                            width: '100%',
                            minWidth: 0,
                            minHeight: 0,
                            maxWidth: 'none',
                            maxHeight: 'none'
                        });
                        $clone.removeAttr("class");
                    },
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
                url: "{{ route('gym-admin.gymsetting.image') }}",
                cache: false,
                processData: false,
                contentType: false,
                data: formData
            }).done(
                function( response ) {
                    if(response.status == 'fail') {

                    }
                    var obj = jQuery.parseJSON( response );
                    $(".profile-img-container_before").hide();
                    $("#img_name").val(obj.image);
                    $('.profile-img-container').removeAttr('style');
                    $( ".profile-img-container" ).wrap( "<div class='imageDelete'></div>" );
                    $('#uploadImage').modal('hide');
                    @if($gymSettings->local_storage == '0')
                        $('#changeProfile').attr('src', "{{ $gymSettingPath }}" + obj.image);
                        var data = '<div class="profile-big-container"> <img src="{{ $gymSettingPath }}' + obj.image + '" class="profile-img-big"><span rel="change" class="change-photo" onclick="forImage(this)">Change Photo</span></div>';
                        $('.changeAfterProfile').attr('src', "{{ $gymSettingPathThumb }}" + obj.image);
                        $('.image-change').attr('src', "{{ $gymSettingPath }}" + obj.image);
                        profile = '<img src="{{ $gymSettingPathThumb }}' + obj.image + '">';
                    @else
                        $('#changeProfile').attr('src', "{{ asset('/uploads/gym_setting/master/') }}"+ '/' + obj.image);
                        var data = '<div class="profile-big-container"> <img src="{{ asset('/uploads/gym_setting/master/') }}'+ '/' + obj.image + '" class="profile-img-big"><span rel="change" class="change-photo" onclick="forImage(this)">Change Photo</span></div>';
                        $('.changeAfterProfile').attr('src', "{{ asset('/uploads/gym_setting/thumb/') }}"+ '/' + obj.image);
                        $('.image-change').attr('src', "{{ asset('/uploads/gym_setting/master/') }}"+ '/' + obj.image);
                        profile = '<img src="{{ asset('/uploads/gym_setting/thumb/') }}'+ '/' + obj.image + '">';
                    @endif
                    $('.popover ').hide();
                });
        }


        (function (factory) {
            if (typeof define === "function" && define.amd) {
                define(["jquery"], factory);
            } else {
                factory(jQuery);
            }
        })(function ($) {

            "use strict";

            var console = window.console || {
                log: $.noop
            };
        });

        function forCustomerImage(task)
        {
            $('#task').val($(task).attr('rel'));
            $('#image').val('');
            $('#uploadCustomerImage').modal('show');
        }

        var originalImage;

        function readCustomerImageURL(input)
        {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#chooseDiv > img').attr('src', e.target.result);
                }
                originalImage = input.files[0];
                reader.readAsDataURL(input.files[0]);
            }
            $('#cropCustomerImage').modal('show');
            $('#uploadCustomerImage').modal('hide');
        }

        $(function() {
            $('#cropCustomerImage').on('shown.bs.modal', function () {
                $('#chooseDiv > img').cropper({
                    dragMode: 'move',
                    guides: true,
                    highlight: true,
                    dragCrop: true,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    mouseWheelZoom: true,
                    touchDragZoom: false,
                    built: function () {

                        // Width and Height params are number types instead of string
                        $('#chooseDiv > img').cropper('setCropBoxData', {width: 800, height: 500});
                        var $clone = $(this).clone();
                        $clone.css({
                            display: 'block',
                            width: '100%',
                            minWidth: 0,
                            minHeight: 0,
                            maxWidth: 'none',
                            maxHeight: 'none'
                        });
                        $clone.removeAttr("class");
                    },
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
                    }
                });
            }).on('hidden.bs.modal', function () {
                advertCropBoxData = $('#chooseDiv > img').cropper('getCropBoxData');
                advertCanvasData = $('#chooseDiv > img').cropper('getCanvasData');
                $('#chooseDiv > img').cropper('destroy');
            });

            $("#cropButton").click(function () {
                uploadCustomerImage();
                $('#cropCustomerImage').modal('hide');
            });
        });
        
        function uploadCustomerImage()
        {
            var image = originalImage;
            var xCoordinate = $('#xCoordOne').val();
            var yCoordinate = $('#yCoordOne').val();
            var profileImageWidth = $('#profileImageWidth').val();
            var profileImageHeight = $('#profileImageHeight').val();
            var formData = new FormData();
            formData.append('xCoordOne', xCoordinate);
            formData.append('yCoordOne', yCoordinate);
            formData.append('profileImageWidth', profileImageWidth);
            formData.append('profileImageHeight', profileImageHeight);
            formData.append('file', image);
            $.ajax({
                type: 'post',
                url: "{{ route('gym-admin.setting.customerImage') }}",
                cache: false,
                processData: false,
                contentType: false,
                data: formData,
                success: function (response) {
                    var obj = jQuery.parseJSON( response );
                    $('#uploadCustomerImage').modal('hide');
                    @if($gymSettings->local_storage == '0')
                    $('#customerImage').attr('src', "{{ $gymSettingPath }}" + obj.image);
                    @else
                    $('#customerImage').attr('src', "{{ asset('/uploads/gym_setting/master/') }}"+ '/' + obj.image);
                    @endif
                }
            })
        }
    </script>
@endpush