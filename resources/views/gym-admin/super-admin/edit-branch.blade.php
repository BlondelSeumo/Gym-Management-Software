@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
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
                <span>Edit Branch</span>
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
                                <span class="caption-subject font-red bold uppercase"> Edit Branch</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#branchTab" tabindex="-1" data-toggle="tab"> Branch </a>
                                </li>
                                <li>
                                    <a href="#permissionTab" tabindex="-1" data-toggle="tab"> Permission and Roles </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="branchTab">
                                    {!! Form::open(['route'=>'gym-admin.superadmin.storeBranchPage','id'=>'branchStoreForm','class'=>'ajax-form form-horizontal','method'=>'POST','files' => true]) !!}
                                    <div class="form-wizard">
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Branch Name <span class="required" aria-required="true"> * </span></label>

                                                <div class="col-md-6 input-icon right">
                                                    <input type="text" class="form-control" name="title" @if(!is_null($branchData)) value="{{ $branchData->title }}" @endif>
                                                    <div class="form-control-focus"></div>
                                                    <span class="help-block">Enter branch name</span>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Address <span class="required" aria-required="true"> * </span></label>
                                                <div class="col-md-6">
                                                    <textarea class="form-control" rows="3" placeholder="Enter address" name="address">@if(!is_null($branchData)) {{ $branchData->address }} @endif</textarea>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Incharge Name <span class="required" aria-required="true"> * </span></label>
                                                <div class="col-md-6 input-icon right">
                                                    <input type="text" class="form-control" name="owner_incharge_name" @if(!is_null($branchData)) value="{{ $branchData->owner_incharge_name }}" @endif>
                                                    <div class="form-control-focus"></div>
                                                    <span class="help-block">Enter incharge name</span>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Mobile <span class="required" aria-required="true"> * </span></label>
                                                <div class="col-md-6 input-icon right">
                                                    <input type="text" class="form-control" name="phone" @if(!is_null($branchData)) value="{{ $branchData->phone }}" @endif>
                                                    <div class="form-control-focus"></div>
                                                    <span class="help-block">Enter incharge name.</span>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Email <span class="required" aria-required="true"> * </span></label>
                                                <div class="col-md-6 input-icon right">
                                                    <input type="text" class="form-control" name="email" @if(!is_null($branchData)) value="{{ $branchData->email }}" @endif>
                                                    <div class="form-control-focus"></div>
                                                    <span class="help-block">Enter e-mail address.</span>
                                                </div>
                                            </div>

                                            <hr>
                                        </div>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <a href="javascript:;" class="btn green" id="storeBranch">Submit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <div class="tab-pane fade" id="permissionTab">
                                    {!! Form::open(['route'=>'gym-admin.superadmin.updateRolesAndPermissionPage','id'=>'updateRolesAndPermissionForm','class'=>'ajax-form form-horizontal','method'=>'POST','files' => true]) !!}
                                    <div class="form-wizard">
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label">Manager</label>
                                                <div class="col-md-6">
                                                    <select class="bs-select form-control" data-live-search="true" data-size="8" name="manager_id" id="manager_id">
                                                        @foreach($managers as $manager)
                                                            <option @if($user->id == $manager->id) selected @endif value="{{ $manager->id }}">{{ ucfirst($manager->first_name).' '.ucfirst($manager->last_name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label">Role</label>
                                                <div class="col-md-6">
                                                    <select class="bs-select form-control" data-live-search="true" data-size="8" name="role_id" id="role_id">
                                                        @foreach($roles as $role)
                                                            <option @if($user->id == $role->user_id) selected @endif value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <a href="javascript:;" class="btn green" id="updateRole">Submit</a>
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
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
    {!! HTML::script('admin/pages/scripts/ui-buttons.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('admin/pages/scripts/components-bootstrap-select.min.js') !!}
    <script>
        $('#storeBranch').click(function () {
            $.easyAjax({
                url: '{{ route('gym-admin.superadmin.update', [$branchData->id]) }}',
                container: '#branchStoreForm',
                type: 'PUT',
                data: $('#branchStoreForm').serialize()
            });
        });

        $('#updateRole').click(function () {
            $.easyAjax({
                url: '{{ route('gym-admin.superadmin.updateRolesAndPermissionPage') }}',
                container: '#updateRolesAndPermissionForm',
                type: 'POST',
                data: $('#updateRolesAndPermissionForm').serialize()
            });
        });
    </script>
@stop