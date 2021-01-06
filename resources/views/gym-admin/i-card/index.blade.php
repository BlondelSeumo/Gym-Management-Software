@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/datatables/datatables.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/Responsive-2.0.2/css/responsive.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/Responsive-2.0.2/css/responsive.dataTables.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}

    <style type="text/css" media="print">
        .no-print { display: none; }
        .only-print{ display: block;}


        .i-card-container{
            /*width: 205px !important;*/
            margin-top: 30px !important;
            max-height: 300px !important;
        }

        .qr-code-container{
            width: 130px !important;
            margin: 0 auto;
        }

        .i-card-contact{
            width: 200px !important;
            padding: 0px 0 5px 30px !important;
        }

        .i-card-user-detail{
            padding: 0 !important;
        }

        div{
            page-break-inside: avoid !important;
        }

        .col-print-4{
            width:33% !important;
            float:left !important;
        }
    </style>

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
                <span>Generate I-Card</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">


            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title no-print">
                            <div class="caption font-dark">
                                <i class="icon-paper-plane font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Generate I-Card</span>
                            </div>
                        </div>
                        <div class="portlet-body">

                            <div id="select-recipient-section" >
                                <h3>Select Clients</h3>


                                {!! Form::open(['id'=>'generateICardForm','class'=>'ajax-form']) !!}

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input ">
                                                <select  class="bs-select form-control" data-live-search="true" data-size="8" name="filter" id="filter">
                                                    <option value="manual">Select Manually</option>
                                                    <option value="all">Select All</option>
                                                </select>
                                                <label for="title">Filter</label>
                                                <span class="help-block"></span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="targetDataTable">
                                    <div class="col-md-12">
                                        <table class="table table-100 table-striped table-bordered table-hover table-checkable order-column responsive sushant" id="promotion_table">
                                            <thead>
                                                <tr>
                                                    <th class="all"> # </th>
                                                    <th class="all"> Name </th>
                                                    <th class="min-tablet"> Mobile </th>
                                                    <th class="min-tablet"> Email </th>
                                                </tr>
                                            </thead>

                                        </table>                                        <!-- END EXAMPLE TABLE PORTLET-->
                                    </div>
                                </div>
                                {!! Form::close() !!}

                                <hr>
                                <div class="row">
                                    <div class="col-md-offset-8 col-md-4 text-right">
                                        <a href="javascript:;" class="btn green btn-lg "
                                           id="generate-submit"><i class="fa fa-send"></i> Generate I-Cards</a>
                                    </div>
                                </div>

                            </div>

                            <div id="i-card-generate" style="display: none">

                                <div class="row no-print">
                                    <div class="col-md-12">
                                        <a href="javascript:;" class="btn red-mint btn-lg" id="select-recipient-back"><i
                                                    class="fa fa-arrow-left"></i> back</a>

                                        <a href="javascript:;" class="btn dark btn-lg" onclick="printDiv('generated-i-cards')"><i
                                                    class="fa fa-print"></i> Print</a>

                                        <a href="javascript:;" id="email-qrcode" class="btn green btn-lg" ><i
                                                    class="fa fa-envelope"></i> Email</a>

                                        <hr>
                                    </div>
                                </div>

                                <h3 class="no-print">View I-Cards</h3>

                                <div id="generated-i-cards">

                                </div>
                            </div>

                            <div id="email-complete" style="display: none;">
                                <div class="row">
                                    <div class="col-md-12 text-center margin-top-75">
                                        <h1>
                                            <i style="font-size: 3em" class="icon-check font-dark"></i>
                                        </h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h1 class="sbold font-dark">Yay! Emails sent successfully!</h1>
                                    </div>
                                </div>

                            </div>


                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT INNER -->
    </div>


    <div class="modal fade bs-modal-md in" id="previewModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    {{--End Modal--}}



@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/bootbox/bootbox.min.js') !!}

    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/jquery.dataTables.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/dataTables.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/dataTables.responsive.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/responsive.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('admin/pages/scripts/components-bootstrap-select.min.js') !!}

    <script>
        $('#filter').change(function(){
            var filter = $('#filter option:selected').val();
            load_data_table(filter);
        });

        $('#select-recipient-back').click(function () {
            $('#i-card-generate').hide();
            $('#select-recipient-section').fadeIn();
        });

        $('#generate-submit').click(function () {
            $.easyAjax({
                'url':'{{ route('gym-admin.i-card.store') }}',
                'container':"#generateICardForm",
                'type':'POST',
                'data':$('#generateICardForm').serialize(),
                success: function (response) {
                    if(response.status == 'success'){
                        $('#generated-i-cards').html(response.content);
                        $('#select-recipient-section').hide();
                        $('#i-card-generate').fadeIn();
                    }
                }
            })
        });

        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML =
                    "<html><body>" +
                    divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;


        }

        function load_data_table(id){
            var table = $('#promotion_table');
            var url = '{{route('gym-admin.i-card.clientList',['#id'])}}';
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

        $('#email-qrcode').click(function () {
            $.easyAjax({
                'url':'{{ route('gym-admin.i-card.email-qr-code') }}',
                'container':"#generateICardForm",
                'type':'POST',
                'data':$('#generateICardForm').serialize(),
                success: function (response) {
                    if(response.status == 'success'){
                        $('#i-card-generate').hide();
                        $('#email-complete').fadeIn();
                    }
                }
            })
        });

        jQuery(document).ready(function() {
            load_data_table('manual');
        });
    </script>
@stop