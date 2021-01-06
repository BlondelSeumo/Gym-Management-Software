@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/datatables/datatables.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/Responsive-2.0.2/css/responsive.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/Responsive-2.0.2/css/responsive.dataTables.css') !!}
    <style>
        .add-pending-btn-gap {
            margin-right: 10px;
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
                <span>Client Subscriptions</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="fa {{ $gymSettings->currency->symbol }} font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Subscriptions</span>
                            </div>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <a class="btn btn-danger add-pending-btn-gap" href="{{ route('gym-admin.client-purchase.pending-subscription') }}">Pending Subscription ({{ $pendingCount }})</a>
                                    <a id="addTarget" href="{{route('gym-admin.client-purchase.create')}}" class="btn sbold dark"> Add New
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                            </div>
                            <table  class="table table-100 table-striped table-bordered table-hover table-checkable order-column responsive" id="purchase_table">
                                <thead>
                                <tr>
                                    <th class="all"> Client </th>
                                    <th class="min-tablet"> Amount To Be Paid </th>
                                    <th class="min-tablet"> Remaining Amount </th>
                                    <th class="min-tablet"> Start Date </th>
                                    <th class="min-tablet"> Next payment </th>
                                    <th class="min-tablet"> Expires On </th>
                                    <th class="min-tablet"> Action </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>

    {{--Model--}}



    <div class="modal fade bs-modal-md in" id="reminderModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{--Model End--}}
@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/jquery.dataTables.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/DataTables-1.10.11/media/js/dataTables.bootstrap.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/dataTables.responsive.js') !!}
    {!! HTML::script('admin/global/plugins/datatables/Responsive-2.0.2/js/responsive.bootstrap.js') !!}
    <script>

    function load_dataTable(){
    var table = $('#purchase_table');

    // begin first table
    table.DataTable({
    "sAjaxSource": "{{ route('gym-admin.client-purchase.ajax-create') }}",
    bDestroy:true,
    "aoColumns": [
    { 'sClass': 'center', "bSortable": true, 'width': '20%'  },
    { 'sClass': 'center', "bSortable": true  },
    { 'sClass': 'center', "bSortable": true  },
    { 'sClass': 'center', "bSortable": true  },
    { 'sClass': 'center', "bSortable": true  },
    { 'sClass': 'center', "bSortable": true  },
    { 'sClass': 'center', "bSortable": false  }
    ],
        "order": [[ 6, "desc" ]],
    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
    responsive: {
    details: {
    renderer: function ( api, rowIdx ) {
    // Select hidden columns for the given row
    var data = api.cells( rowIdx, ':hidden' ).eq(0).map( function ( cell ) {
    var header = $( api.column( cell.column ).header() );

    return '<tr>'+
        '<td>'+
            header.text()+':'+
            '</td> '+
        '<td>'+
            api.cell( cell ).data()+
            '</td>'+
        '</tr>';
    } ).toArray().join('');

    return data ?
    $('<table/>').append( data ) :
    false;
    }
    }
    },
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
    [5, 15, 20, -1],
    [5, 15, 20, "All"] // change per page values here
    ]
    });
    }
    </script>
    <script>
        $(document).ready(function(){
            load_dataTable();
        });
    </script>
    <script>
        $('#purchase_table').on('click','.remove-purchase',function(){
            var id = $(this).data('id');
            bootbox.confirm({
                message: "Do you want to delete this purchase?",
                buttons: {
                    confirm: {
                        label: "Yes",
                        className: "btn-primary"
                    }
                },
                callback: function(result){
                    if(result){

                        var url = '{{route('gym-admin.client-purchase.destroy',':id')}}';
                        url = url.replace(':id',id);

                        $.easyAjax({
                            url: url,
                            type: "DELETE",
                            data: {id: id,_token: '{{ csrf_token() }}'},
                            success: function(){
                                load_dataTable();
                            }
                        });
                    }
                    else {
                        console.log('cancel');
                    }
                }
            })
        });

        $('#purchase_table').on('click','.add-payment', function () {
            var id = $(this).data('id');
            var show_url = '{{route('gym-admin.membership-payments.add-payment-modal',['#id'])}}';
            var url = show_url.replace('#id', id);
            $('#modelHeading').html('Select Time');
            $.ajaxModal("#reminderModal", url);
        });

        $('#purchase_table').on('click','.renew-subscription', function () {
            var id = $(this).data('id');
            var show_url = '{{route('gym-admin.client-purchase.renew-subscription-modal',['#id'])}}';
            var url = show_url.replace('#id', id);
            $('#modelHeading').html('Renew Subscription');
            $.ajaxModal("#reminderModal", url);
        });

        //        send subscription reminder
        $('#purchase_table').on('click','.show-subscription-reminder', function () {
            var id = $(this).data('id');
            var show_url = '{{route('gym-admin.client-purchase.show-subscription-reminder-modal',['#id'])}}';
            var url = show_url.replace('#id', id);
            $('#modelHeading').html('Select Time');
            $.ajaxModal("#reminderModal", url);
        });

    </script>

@stop