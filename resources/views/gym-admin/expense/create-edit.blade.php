@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
    <style>
        .bill-color {
            color: #888;
        }
        .file-size {
            line-height: 0;
            color: #a2a2a2;
            font-size: 13px;
        }
    </style>
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
                <a href="{{ route('gym-admin.expense.index') }}">Expense</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>@if(isset($expense->id)) Edit @else Add @endif Expense</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">


            <div class="row">
                <div class="col-md-7 col-xs-12">

                    <div class="portlet light portlet-fit">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-plus font-red"></i><span class="caption-subject font-red bold uppercase">@if(isset($expense->id)) Edit @else Add @endif Expense</span></div>


                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            {!! Form::open(['id'=>'create-edit-expense','class'=>'ajax-form']) !!}
                            <div class="form-body">
                                @if(isset($expense->id))
                                    <input type="hidden" name="_method" value="PUT">
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" placeholder="Item Name" name="item_name" value="{{$expense->item_name or ''}}">
                                                <label for="form_control_1">Item Name<span class="required" aria-required="true"> * </span></label>
                                                <span class="help-block">Add Item Name</span>
                                                <i class="fa fa-sticky-note-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" placeholder="Purchase From" name="purchase_from" value="{{$expense->purchase_from or ''}}">
                                                <label for="form_control_1">Purchase From</label>
                                                <span class="help-block">Add Shop Name</span>
                                                <i class="fa fa-shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input ">
                                    <div class="input-group left-addon right-addon">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control date-picker" readonly name="purchase_date" value="@if(isset($expense->id)) {{ \Carbon\Carbon::createFromFormat('Y-m-d', $expense->purchase_date)->format('m/d/Y') }} @else {{ \Carbon\Carbon::now('Asia/Calcutta')->format('m/d/Y') }} @endif">
                                        <label for="payment_date">Purchase Date<span class="required" aria-required="true"> * </span></label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" placeholder="Price" name="price" value="{{$expense->price or ''}}">
                                                <label for="form_control_1">Price<span class="required" aria-required="true"> * </span></label>
                                                <span class="help-block">Add Price of Item</span>
                                                <i class="fa {{ $gymSettings->currency->symbol }}"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 bill-color">Bill</label>
                                        <div class="col-md-12">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                        <span class="fileinput-filename">{{$expense->bill or ''}}</span>
                                                    </div>
                                                    <span class="input-group-addon btn default btn-file">
                                                        <span class="fileinput-new"> Select file </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" name="bill">
                                                    </span>
                                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                    @if(isset($expense->id) && $expense->bill != null)
                                                        <a class="input-group-addon btn default" href="{{$expenseUrl.$expense->bill}}" target="_blank">Show Bill</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions" style="margin-top: 70px">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn dark mt-ladda-btn ladda-button" data-style="zoom-in" onclick="addUpdate({{ $expense->id or ''}})">
                                            <span class="ladda-label"><i class="fa fa-save"></i> Save</span>
                                        </button>
                                        <a type="button" class="btn default" href="{{ route('gym-admin.expense.index') }}">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                        <!-- END FORM-->
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
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
    {!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
    {!! HTML::script('admin/pages/scripts/ui-buttons.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('admin/pages/scripts/components-bootstrap-select.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
<script>
    $('.date-picker').datepicker({
        rtl: App.isRTL(),
        orientation: "left",
        autoclose: true
    });

    function addUpdate(id) {

        var url;
        if(typeof id!='undefined') {
            url ="{{route('gym-admin.expense.update',':id')}}";
            url = url.replace(':id',id);
        } else {
            url ="{{route('gym-admin.expense.store')}}";
        }

        $.easyAjax({
            type: "POST",
            url: url,
            file: true,
            container: '#create-edit-expense'
        });
    }
</script>
@stop