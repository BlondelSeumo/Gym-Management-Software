@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/bootstrap-daterangepicker/daterangepicker.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/datatables.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/Responsive-2.0.2/css/responsive.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/Responsive-2.0.2/css/responsive.dataTables.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
@stop

@section('content')
    <div class="container-fluid"      >
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{route('gym-admin.dashboard.index')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{route('gym-admin.promotion.index')}}">Promotion</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Send Promotion</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row widget-row">
                <div class="col-md-3">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                        <h4 class="widget-thumb-heading">SMS Credits</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-blue icon-grid"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">Balance</span>
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$credits}}">0</span>
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>

                {{--<div class="col-md-3">--}}
                {{--<!-- BEGIN WIDGET THUMB -->--}}
                {{--<div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">--}}
                {{--<h4 class="widget-thumb-heading">Package</h4>--}}
                {{--<div class="widget-thumb-wrap">--}}
                {{--<i class="widget-thumb-icon bg-red icon-present"></i>--}}
                {{--<div class="widget-thumb-body">--}}
                {{--<span class="widget-thumb-subtitle">Count</span>--}}
                {{--<span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$packageCount}}">0</span>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<!-- END WIDGET THUMB -->--}}
                {{--</div>--}}
                {{--<div class="col-md-3">--}}
                {{--<!-- BEGIN WIDGET THUMB -->--}}
                {{--<div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">--}}
                {{--<h4 class="widget-thumb-heading">Offer</h4>--}}
                {{--<div class="widget-thumb-wrap">--}}
                {{--<i class="widget-thumb-icon bg-purple fa fa-circle-thin"></i>--}}
                {{--<div class="widget-thumb-body">--}}
                {{--<span class="widget-thumb-subtitle">Count</span>--}}
                {{--<span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$offerCount}}">0</span>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<!-- END WIDGET THUMB -->--}}
                {{--</div>--}}
            </div>


            {!! Form::open(['id'=>'createTargetReport','class'=>'ajax-form']) !!}
            <div class="row">
                <div class=" col-md-12 ">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-paper-plane font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Send Promotions</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-8">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input ">
                                            <select  class="bs-select form-control" data-live-search="true" data-size="8" name="filter" id="filter">
                                                <option value="all">Select All</option>
                                                <option value="manual">Manually Select</option>
                                                <option value="random">Select Random</option>
                                                <option value="male">Select all Male</option>
                                                <option value="female">Select all Female</option>
                                            </select>
                                            <label for="title">Filter</label>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <input type="text" class="form-control" id="campaign" name="campaign">
                                            <label for="form_control_1">Campaign Name</label>
                                            <span class="help-block">Please enter campaign name.</span>
                                        </div>
                                        <div class="form-group form-md-line-input form-md-floating-label" id="random_div" style="display: none">
                                            <input type="text" class="form-control" id="random" name="random">
                                            <label for="form_control_1">Random Records</label>
                                            <span class="help-block">Please enter number of random records.</span>
                                        </div>
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <textarea class="form-control " rows="3" name="sms_text" id="sms_text" maxlength="160"></textarea>
                                            <label for="form_control_1">SMS Text</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row" id="targetDataTable">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-badge font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Clients</span>
                            </div>
                        </div>
                        <div class="portlet-body">

                            <div class="row">
                            <div class="col-xs-12">


                                <table class="table table-100 table-striped table-bordered table-hover table-checkable order-column responsive sushant" id="promotion_table">
                                    <thead>
                                    <tr>
                                        <th class="all"> # </th>
                                        <th class="all"> Name </th>
                                        <th class="min-tablet"> Email </th>
                                        <th class="min-tablet"> Mobile </th>
                                        <th class="min-tablet"> Age </th>
                                        <th class="min-tablet"> Gender </th>
                                    </tr>
                                    </thead>

                                </table>

                            </div>
                            </div>

                            <div class="row">
                            <div class="col-xs-12">
                                <a href="javascript:;" id="update_attendence" class="btn green save-form" onclick="sendPromotions()"><i
                                            class="fa fa-send"></i> SEND PROMOTION
                                </a>
                            </div>
                            </div>

                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
            {!! Form::close() !!}


        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/counterup/jquery.counterup.js') !!}
    {!! HTML::script('admin/global/plugins/counterup/jquery.waypoints.min.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/jquery.dataTables.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/dataTables.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/dataTables.responsive.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/responsive.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('admin/pages/scripts/components-bootstrap-select.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') !!}
    {!! HTML::script('admin/pages/scripts/components-bootstrap-maxlength.min.js') !!}
    {!! HTML::script('admin/global/plugins/uniform/jquery.uniform.js') !!}

    <script>
        $('#sms_text').maxlength({
            limitReachedClass: "label label-danger",
            alwaysShow: true
        });
    </script>

    <script>
        $('#filter').change(function(){
            var filter = $('#filter option:selected').val();
            load_data_table(filter);
            if(filter == 'random')
            {
                $('#random_div').css('display','block');
            }else{
                $('#random_div').css('display','none');
            }

        });
    </script>

    <script>
       function sendPromotions(){
           var filter = $('#filter option:selected').val();
           if(filter == 'random')
           {
               var random_num = $('#random').val();
               if(random_num !='')
               {
                   ajaxPromotion();
               }else {
                   $('#random_div').addClass('has-error');
                   $.showToastr('Random Records field  is required','error');
               }
           }else{
               ajaxPromotion();
           }
        }

        function ajaxPromotion() {
            $('#random_div').removeClass('has-error');
            $.easyAjax({
                'url':'{{route('gym-admin.promotion.store')}}',
                'container':"#createTargetReport",
                'type':'POST',
                'data':$('#createTargetReport').serialize()
            })
        }
    </script>
    <script>
        function load_data_table(id){
            var table = $('#promotion_table');
            var url = '{{route('gym-admin.promotion.ajax-create',['#id'])}}';
            url = url.replace('#id',id);
            // begin first table
            table.DataTable({
                "sAjaxSource": url,
                bDestroy:true,
                scrollY:        300,
                deferRender:    true,
                scroller:       true,
                "aoColumns": [
                    { 'sClass': 'center', "bSortable": false },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  },
                    { 'sClass': 'center', "bSortable": true  }
                ],
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
                    "search": "Search:",
                    "zeroRecords": "No matching records found",
                    "paginate": {
                        "previous":"Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First"
                    }
                },
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [-1],
                    ["All"] // change per page values here
                ]
            });
        }

    </script>
    <script>
        $(document).ready(function(){
            load_data_table('all');
        });
    </script>

@stop