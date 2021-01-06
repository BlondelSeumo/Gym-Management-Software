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
                <span>Branch Setup 3 of 4</span>
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
                                <span class="caption-subject font-red bold uppercase"> STEP 3 of 4 </span>
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

                            {!! Form::open(['route'=>'gym-admin.superadmin.storeRolePage','id'=>'roleStoreForm','class'=>'ajax-form form-horizontal','method'=>'POST','files' => true]) !!}
                            <div class="form-wizard">
                                <div class="form-body">
                                    <ul class="nav nav-pills nav-justified steps">
                                        @if(!is_null($branchData) > 0)
                                            <li>
                                                <a href="{{ route('gym-admin.superadmin.branch', [$branchData->id]) }}" class="step">
                                                    <span class="number"> 1 </span>
                                                    <span class="desc">
                                                                            <i class="fa fa-check"></i> Add Branch </span>
                                                </a>
                                            </li>
                                        @endif
                                        @if(isset($manager_id))
                                            <li>
                                                <a href="{{ route('gym-admin.superadmin.manager', [$manager_id]) }}" class="step">
                                                    <span class="number"> 2 </span>
                                                    <span class="desc">
                                                                            <i class="fa fa-check"></i> Add Manager </span>
                                                </a>
                                            </li>
                                        @endif
                                        <li class="active">
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
                                    @if(isset($role) && count($role) > 0)
                                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                                    @endif
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label">Branch Name</label>
                                        <div class="col-md-6">
                                            <select class="bs-select form-control" data-live-search="true" data-size="8" name="branch_id" id="branch_id">
                                                    <option selected value="{{ $branchData->id }}">{{ ucwords($branchData->title) }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">Role Name <span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-6 input-icon right">
                                            <input type="text" class="form-control" name="role" @if(isset($role) && count($role) > 0 && isset($role->name)) value="{{ $role->name }}" @endif>
                                            <div class="form-control-focus"></div>
                                            <span class="help-block">Enter role name</span>
                                        </div>
                                    </div>

                                    <hr>
                                </div>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <a href="javascript:;" class="btn green" id="storeRole">Submit</a>
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
    </div>
@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
    {!! HTML::script('admin/pages/scripts/ui-buttons.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('admin/pages/scripts/components-bootstrap-select.min.js') !!}
    <script>
        $('#storeRole').click(function () {
            $.easyAjax({
                url: '{{ route('gym-admin.superadmin.storeRolePage') }}',
                container: '#roleStoreForm',
                type: 'POST',
                data: $('#roleStoreForm').serialize()
            });
        });
    </script>
@stop