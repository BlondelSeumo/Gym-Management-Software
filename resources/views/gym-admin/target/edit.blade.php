@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
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
                <a href="{{ route('gym-admin.target.index') }}">Target</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Edit Target</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet light portlet-fit">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-plus font-red"></i><span class="caption-subject font-red bold uppercase">Edit Target</span></div>
                        </div>
                        <div class="portlet-body">
                            {!! Form::open(['id'=>'editTargetForm','class'=>'ajax-form']) !!}
                                <input type="hidden" name="_method" value="put">
                            <div class="form-body">

                                <div class="form-group form-md-line-input ">
                                    <select  class="bs-select form-control" data-live-search="true" data-size="8" name="target_type" id="target_type">
                                        @foreach($target_type as $type)
                                            <option value="{{$type->id}}" @if($target->target_type == $type->id ) selected @endif>{{ucfirst($type->type)}}</option>
                                        @endforeach
                                    </select>
                                    <label for="title">Target Type</label>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <div class="input-group left-addon right-addon">
                                        <span class="input-group-addon"><i class="icon-tag"></i></span>
                                        <input type="text" class="form-control" name="title" id="title" value="{{$target->title}}">
                                        <span class="help-block">Enter target name</span>
                                        <label for="price">Target Name</label>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <div class="input-group left-addon right-addon">
                                        <span class="input-group-addon"><i class="icon-bag"></i></span>
                                        <input type="number" min="0" class="form-control" name="value" id="value" value="{{$target->value}}">
                                        <span class="help-block">Enter target value</span>
                                        <label for="price">Target Value</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <input type="text" readonly class="form-control date-picker" placeholder="Select Start Date" name="start_date" id="start_date" value="{{\Carbon\Carbon::createFromFormat('Y-m-d',$target->start_date)->format('m/d/Y')}}" >
                                                <label for="form_control_1 ">Start Date</label>
                                                <span class="help-block">Start Date</span>
                                                <i class="icon-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" readonly class="form-control date-picker" placeholder="Select End Date" name="date" id="date" value="{{\Carbon\Carbon::createFromFormat('Y-m-d',$target->date)->format('m/d/Y')}}" >
                                                <label for="form_control_1">End Date</label>
                                                <span class="help-block">End Date</span>
                                                <i class="icon-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>





                            </div>

                            <div class="form-actions" style="margin-top: 70px">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn dark mt-ladda-btn ladda-button" data-style="zoom-in" id="save-form">
                                            <span class="ladda-label"><i class="fa fa-save"></i> SAVE</span>
                                        </button>
                                        <button type="reset" class="btn default">Reset</button>
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
    {!! HTML::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
    {!! HTML::script('admin/pages/scripts/ui-buttons.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('admin/pages/scripts/components-bootstrap-select.min.js') !!}
    <script>
        $('#start_date').datepicker({
            autoclose: true,
        }).on('changeDate', function(){
            $('#date').datepicker('setStartDate', new Date($(this).val()));
        });

        $('#date').datepicker({
            autoclose: true,
        }).on('changeDate', function(){
            $('#start_date').datepicker('setEndDate', new Date($(this).val()));
        });
    </script>
    <script>
        $('#save-form').click(function(){
            var url_update = '{{route('gym-admin.target.update',['#id'])}}';
            var url = url_update.replace('#id','{{$target->id}}');

            $.easyAjax({
                url:url,
                container:'#editTargetForm',
                type:'POST',
                data:$('#editTargetForm').serialize()
            });
        });
    </script>

@stop
