@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
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
                <a href="{{ route('gym-admin.gymmerchantroles.index') }}">Roles</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Edit Role</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-7 col-xs-12">

                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-pencil font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Edit Role</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            {!! Form::open(['id'=>'profileUpdateForm','class'=>'ajax-form form-horizontal','method'=>'PUT','files' => true]) !!}
                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Role Name</label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <input type="text" class="form-control" placeholder="Role Name" name="name" id="name" value="{{ $role->name }}">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Enter role name</span>
                                            <i class="icon-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="javascript:;" class="btn green" id="updateProfile">Submit</a>
                                        <a href="{{ route('gym-admin.gymmerchantroles.index') }}" class="btn default">Cancel</a>
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

    <script>
        $('#updateProfile').click(function(){
            var url = '{{route('gym-admin.gymmerchantroles.update', $role->id)}}';
            $.easyAjax({
                url:url,
                container:'#profileUpdateForm',
                type: "POST",
                data:$('#profileUpdateForm').serialize()
            })
        });

    </script>

@stop