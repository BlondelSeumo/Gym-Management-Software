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
                <span>Branch Setup 4 of 4</span>
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
                                <span class="caption-subject font-red bold uppercase"> STEP 4 of 4 </span>
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

                            {!! Form::open(['route'=>'gym-admin.superadmin.permission','id'=>'branchPermissionForm','class'=>'ajax-form form-horizontal','method'=>'POST','files' => true]) !!}
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
                                        @if(isset($manager_id))
                                            <li>
                                                <a href="{{ route('gym-admin.superadmin.manager', [$manager_id]) }}" class="step">
                                                    <span class="number"> 2 </span>
                                                    <span class="desc">
                                                                            <i class="fa fa-check"></i> Add Manager </span>
                                                </a>
                                            </li>
                                        @endif
                                        @if(count($roles) > 0)
                                            <li>
                                                <a href="{{ route('gym-admin.superadmin.role', [$roles->id]) }}"
                                                   class="step active">
                                                    <span class="number"> 3 </span>
                                                    <span class="desc">
                                                                            <i class="fa fa-check"></i> Add Role </span>
                                                </a>
                                            </li>
                                        @endif
                                        <li class="active">
                                            <a href="javascript:;" class="step">
                                                <span class="number"> 4 </span>
                                                <span class="desc">
                                                                        <i class="fa fa-check"></i> Add Permission </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="col-xs-12 bg-grey-steel bg-font-grey-steel">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <h3>Role: {{ ucfirst($roles->name) }}</h3>
                                                <input type="hidden" name="role_id" value="{{ $roles->id }}">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 ">
                                                <h3>
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" name="check_all" id="check_all" value="1"
                                                               class="md-check">

                                                        <label for="check_all">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Check All </label>
                                                    </div>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="form-group text-center">
                                        <input type="hidden" name="permissions">
                                    </div>
                                    @foreach($permissions as $permission)
                                        <div class="col-xs-12 col-md-3">
                                            <div class="md-checkbox">
                                                <input type="checkbox" name="permissions[]" id="permission-{{ $permission->id }}" value="{{ $permission->id }}"
                                                       @if(isset($userPermissions))
                                                           @foreach($userPermissions as $userPermission)
                                                               @if($userPermission->permission_id == $permission->id)
                                                                    checked
                                                               @endif
                                                           @endforeach
                                                       @endif
                                                       class="md-check">

                                                <label for="permission-{{ $permission->id }}">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> {{ ucwords($permission->display_name) }} </label>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="clearfix"></div>
                                    <hr>
                                </div>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <a href="javascript:;" class="btn green" id="storePermission">Submit</a>
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
        $('#check_all').change(function () {
            var check = $(this).prop('checked');

            $("input[name='permissions[]']").each( function () {
                if(check == true)
                {
                    $(this).attr('checked', 'checked').closest('span').addClass('checked');
                }else {
                    $(this).removeAttr('checked').closest('span').removeClass('checked');
                }
            });


        });

        $('#storePermission').click(function () {
            $.easyAjax({
                url: '{{ route('gym-admin.superadmin.storePermissionPage') }}',
                container: '#branchPermissionForm',
                type: 'POST',
                data: $('#branchPermissionForm').serialize()
            });
        });
    </script>
@stop