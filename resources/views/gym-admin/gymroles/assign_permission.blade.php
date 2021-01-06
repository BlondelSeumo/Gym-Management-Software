@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}

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
                <span>Assign Role</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class=" col-xs-12">

                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-lock font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Assign Permission</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            {!! Form::open(['id'=>'profileUpdateForm','class'=>'ajax-form form-horizontal form-bordered form-row-stripped','method'=>'POST','files' => true]) !!}


                            <div class="col-xs-12 bg-grey-steel bg-font-grey-steel">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <h3>Role: {{ ucfirst($role->name) }}</h3>

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


                            <div class="form-body">
                                <div class="form-group">

                                @foreach($permissions_all as $perm)
                                        <div class="col-xs-12 col-md-3">
                                            <div class="md-checkbox">
                                                <input type="checkbox" name="permissions[]" id="permission-{{ $perm->id }}" value="{{ $perm->id }}"
                                                    @foreach($permissions as $permission)
                                                        @if($permission->permission_id == $perm->id)
                                                            checked
                                                        @endif
                                                    @endforeach
                                                class="md-check">

                                                <label for="permission-{{ $perm->id }}">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> {{ ucwords($perm->display_name) }} </label>
                                            </div>
                                    </div>

                                @endforeach
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-4 col-md-8">
                                        <a href="javascript:;" class="btn green" id="updateProfile">Save Permissions</a>
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
    {!! HTML::script('admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('admin/pages/scripts/components-bootstrap-select.min.js') !!}

    <script>

        $('#check_all').change(function () {
            console.log($("input[name='permissions[]']").length+' '+$(this).prop('checked'));
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

        $('#updateProfile').click(function(){
            var url = '{{route('gym-admin.gymmerchantroles.assign-permission-store', $role->id)}}';
            $.easyAjax({
                url:url,
                container:'#profileUpdateForm',
                type: "POST",
                data:$('#profileUpdateForm').serialize()
            })
        });

    </script>

@stop