@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('css/cropper.css')!!}
    {!! HTML::style('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-toastr/toastr.min.css') !!}
    @stack('general-styles')
    @stack('mail-styles')
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
                <span>Settings</span>
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
                                <i class="icon-settings font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Settings</span>
                            </div>
                        </div>
                        @yield('settingBody')
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

                            <a href="javascript:;" class="btn mini red margin-bottom-10" id="deleteProfileImage">Delete My Profile Picture</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End For Upload Image-->

        <!--Start Image Upload-->
        <div class="modal fade" id="uploadFrontImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="text-align: left">Upload Login Image</h4>
                    </div>
                    <div id="imageUploadDiv" class="text-center">
                        <div class="uploadMsg"></div>
                        <div class="modal-body">
                            <div id="choose" class="margin-bottom-10 margin-top-10">
                                <form method="post" id="imageUploadForm" role="form" enctype="multipart/form-data" class="avatar-form">
                                    <input class="avatar-task" type="hidden" id="task">
                                    <span class="btn green btn-file ">
                           Browse <input type="file" name="file" id="image" class="avatar-input" onchange="uploadLoginImage(this)">
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
                        <h4 class="modal-title" style="text-align: left">Upload Logo</h4>
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

        <!--Start Image Upload-->
        <div class="modal fade" id="uploadCustomerImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="text-align: left">Upload Customer Logo</h4>
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
                           Browse <input type="file" name="file" id="image" class="avatar-input" onchange="readCustomerImageURL(this)">
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
        <div class="modal fade" id="cropCustomerImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="text-align: left">Upload Logo</h4>
                    </div>
                    <div id="imageUploadDiv">
                        <div class="uploadMsg"></div>
                        <div class="modal-body">
                            <div id="chooseDiv">
                                <img id="croppedImage" height="300px">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn red" data-dismiss="modal">CLOSE</button>
                            <button type="button" class="btn green" id="cropButton">UPLOAD</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End For Image Crop Modal-->
    </div>
@stop

@section('footer')
    {!! HTML::script('admin/pages/scripts/ui-toastr.js') !!}
    @stack('general-scripts')
    @stack('mail-scripts')
    @stack('file-upload-scripts')
    @stack('other-scripts')
    @stack('footer-scripts')
@stop