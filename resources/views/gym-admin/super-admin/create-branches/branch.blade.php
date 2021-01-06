@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
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
                <span>Branch Setup 1 of 4</span>
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
                                <span class="caption-subject font-red bold uppercase"> STEP 1 of 4 </span>
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

                            {!! Form::open(['route'=>'gym-admin.superadmin.storeBranchPage','id'=>'branchStoreForm','class'=>'ajax-form form-horizontal','method'=>'POST','files' => true]) !!}
                            <div class="form-wizard">
                                <div class="form-body">
                                    <ul class="nav nav-pills nav-justified steps">
                                        <li class="active">
                                            <a href="javascript:;" class="step">
                                                <span class="number"> 1 </span>
                                                <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Branch </span>
                                            </a>
                                        </li>
                                        <li>
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
                                    @if(isset($branchData->id))
                                        <input type="hidden" name="branch_id" value="{{ $branchData->id }}">
                                    @endif
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
    <script>
        $('#storeBranch').click(function () {
            $.easyAjax({
                url: '{{ route('gym-admin.superadmin.storeBranchPage') }}',
                container: '#branchStoreForm',
                type: 'POST',
                data: $('#branchStoreForm').serialize()
            });
        });
    </script>
@stop