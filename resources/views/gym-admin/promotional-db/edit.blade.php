@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
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
                <a href="{{route('gym-admin.promotion-db.index')}}">Promotional Database</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Edit</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">

            <div class="row">
                {!! Form::open(['route'=>'gym-admin.client.update','id'=>'clients_details','class'=>'ajax-form','method'=>'POST']) !!}
                <div class="col-md-6">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-green">
                                <i class="icon-pin font-green"></i>
                                <span class="caption-subject bold uppercase"> Client Details </span>
                            </div>
                        </div>
                        <input type="hidden" name="_method" value="put">
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control" id="name" name="name" value="{{$client->name}}" >
                                    <label for="form_control_1"> Name</label>
                                    <span class="help-block">Please enter clients name.</span>
                                </div>

                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control" id="email" name="email" value="{{$client->email}}" >
                                    <label for="form_control_1"> Email</label>
                                    <span class="help-block">Please enter clients email.</span>
                                </div>

                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="number" class="form-control" id="mobile" name="mobile" value="{{$client->mobile}}" >
                                    <label for="form_control_1"> Mobile</label>
                                    <span class="help-block">Please enter clients mobile.</span>
                                </div>

                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control" id="age" name="age" value="{{$client->age}}" >
                                    <label for="form_control_1"> Age</label>
                                    <span class="help-block">Please enter clients age.</span>
                                </div>

                                <div class="form-group form-md-line-input ">
                                    <select class="bs-select form-control" data-live-search="true" data-size="8" name="gender" id="gender">
                                        <option value="male" @if($client->gender =='male') selected @endif>Male</option>
                                        <option value="female" @if($client->gender =='female') selected @endif >Female</option>
                                    </select>
                                    <label for="title">Gender</label>
                                    <span class="help-block"></span>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn dark mt-ladda-btn ladda-button save-form" data-style="zoom-in" id="save-form">
                                            <span class="ladda-label">
                                                <i class="fa fa-save"></i> SAVE</span>
                                            <span class="ladda-spinner"></span>
                                            <div class="ladda-progress" style="width: 0px;"></div>
                                        </button>
                                        <button type="reset" class="btn default">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('admin/pages/scripts/components-bootstrap-select.min.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
    {!! HTML::script('admin/pages/scripts/ui-buttons.min.js') !!}

    <script>
        $('.save-form').click(function(){
            $.easyAjax({
                url: '{{route('gym-admin.promotion-db.update',[$client->id])}}',
                container:'#clients_details',
                type: "PUT",
                data: $('#clients_details').serialize()
            })
        });
    </script>


@stop