@extends('layouts.gym-merchant.gymbasic')

@section('CSS')

    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/datepicker.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
    {!! HTML::style('admin/pages/css/search.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}

    <style>
        .dataTables_filter {
            display: none;
        }
    </style>

@stop

@section('content')
    <div class="container-fluid">
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{ route('gym-admin.dashboard.index') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Attendance</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="search-page search-content-1">
                <div class="search-bar ">


                    <div class="row">

                        <div class="col-md-5">
                            <input data-date-format="dd/MM/yyyy" readonly type="text" id="attendance-date"
                                   class="form-control  date-picker search-box"
                                   value="{{ \Carbon\Carbon::now('Asia/Calcutta')->format('d/M/Y') }}"
                                   placeholder="Attendance Date">
                        </div>

                        <div class="col-md-7">
                            <div class="input-group">
                                <input type="text" id="search" class="form-control search-box"
                                       placeholder="Search for...">
                                                <span class="input-group-btn">
                                                    <button id="search-btn" class="btn blue uppercase bold"
                                                            type="button">Search
                                                    </button>
                                                </span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table"
                               id="checkin_clients" style="">
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- END PAGE CONTENT INNER -->

        {{--Modal Start--}}
        <div class="modal fade bs-modal-md in" id="attendenceModal" role="dialog" aria-labelledby="myModalLabel"
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
    </div>
@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/bootbox/bootbox.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') !!}
    {!! HTML::script('admin/global/scripts/datatable.js') !!}
    {!! HTML::script('admin/pages/scripts/table-datatables-managed.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/datatables.min.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
    {!! HTML::script('admin/pages/scripts/components-date-time-pickers.min.js') !!}

    <script>

        $('#attendance-date').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true,
            endDate: '+0d'
        }).on('changeDate', function (ev) {
            dTable.init();
        });

        var dTable = function () {

            var o = function () {

                var table = $('#checkin_clients');
                // begin first table
                table.dataTable({
                    {{--"sAjaxSource": "{{ route('gym-admin.attendance.ajax_create') }}?date=" + $('#attendance-date').val(),--}}
                    "language": {
                        "loadingRecords": '<div class="loading-message"><div class="block-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>' //add a loading image,simply putting <img src="loader.gif" /> tag.
                    },
                    ajax: {
                        url: "{{ route('gym-admin.attendance.ajax_create') }}",
                        data: function (d) {
                            d.date = $('#attendance-date').val();
                            d.search_data = $('#search').val();
                        }
                    },
                    "bDestroy": true,
                    "aoColumns": [
                        {'sClass': 'center', "bSortable": false}
                    ],
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                    "lengthMenu": [
                        [5, 15, 20, -1],
                        [5, 15, 20, "All"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 5,
                    "pagingType": "bootstrap_full_number",
                    "bInfo": false,
                    "bLengthChange": false,
                    "fnDrawCallback": function (oSettings) {
                        $(oSettings.nTHead).hide();
                    },

                });
            }
            return {
                init: function () {
                    o()
                }
            }


            $('.table-scrollable').css('border', '0px');
            $('.table-scrollable').css('margin', '0 !important');
            oTable = $('#checkin_clients').DataTable();   //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
        }();

        $('#search-btn').click(function () {
            dTable.init();
        });

        $('#search').on('keypress', function(event) {
            if(event.keyCode == 13) {
                dTable.init();
            }
        });

    </script>
    <script>

        $('#checkin_clients').on('click', '.mark-check-in', function () {
            var clientId = $(this).data('client-id');
            var show_url = '{{route('gym-admin.attendance.checkin',['#clientId'])}}';
            var url = show_url.replace('#clientId', clientId);
            $('#modelHeading').html('Select Time');
            $.ajaxModal("#attendenceModal", url);
        });


        function writeCheckOut(id, attendance, delete_id) {
            $('#check-in-btns-' + id).html('<a href="javascript:;" class="btn btn-block btn-sm blue-ebonyclay"> <i class="icon-pointer"></i>'
                    + 'Checked In at ' + attendance
                    + '</a>'

                    + '<button  data-delete-id="' + delete_id + '" data-client-id="' + id + '"  class="delete-button margin-top-10 btn btn-lg btn-block red-flamingo"> <i class="icon-close"></i>'
                    + '        Remove Check In'
                    + '</button>');
        }
    </script>

    <script>
        var UIBootbox = function () {
            var o = function () {
                $("#checkin_clients").on('click', '.delete-button', function () {
                    var delete_id = $(this).data('delete-id');
                    var client_id = $(this).data('client-id');

                    bootbox.confirm({
                        message: "Do you want to remove this check in?",
                        buttons: {
                            confirm: {
                                label: "Yes",
                                className: "btn-primary"
                            }
                        },
                        callback: function (result) {
                            if (result) {

                                var url_delete = '{{ route("gym-admin.attendance.destroy",['#id']) }}';
                                var url = url_delete.replace('#id', delete_id);
                                $.easyAjax({
                                    url: url,
                                    type: "DELETE",
                                    data: {id: delete_id, _token: '{{ csrf_token() }}'},
                                    success: function () {
                                        $('#check-in-btns-' + client_id).html(
                                                '<button id ="checkIn" data-client-id="' + client_id + '" onclick="showModel(' + client_id + ')"  class="mark-check-in btn-block btn btn-lg green-jungle "> <i class="icon-check"></i>Check In </button>');
                                        dTable.init();
                                    }
                                });
                            }
                            else {
                                console.log('cancel');
                            }
                        }
                    })

                })
            };
            return {
                init: function () {
                    o()
                }
            }
        }();
        jQuery(document).ready(function () {
            UIBootbox.init()
            dTable.init();
        });
    </script>


@stop