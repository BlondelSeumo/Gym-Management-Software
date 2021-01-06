@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!!  HTML::style("admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")!!}
    {!! HTML::style("admin/global/plugins/datatables/plugins/responsive/responsive.bootstrap.css")!!}
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
                <a href="{{route('gym-admin.client.index')}}">Customer</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Import</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">


            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered" id="beforeSubmitting">
                        <div class="portlet-title">
                            <div class="caption red-sunglo">
                                <i class="fa fa-close font-red-sunglo"></i> Failed Records
                            </div>
                            <div class="actions">
                                <a href="{{ route("gym-admin.client.index") }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> <span class="hidden-xs">Go to Client List</span></a>
                                <a href="{{ route("gym-admin.client.downloadFailedRecords") }}" class="btn btn-primary"><i class="fa fa-download"></i> <span class="hidden-xs">Download Failed Records</span></a>
                            </div>
                        </div>

                        <div class="portlet-body form">
                            <form class="form-horizontal">
                                <div class="form-body">
                                    <div class="alert alert-info"><strong>Info!</strong>  All clients are imported successfully.
                                    </div>
                                    <p>We could not import following employee records. Fail reason is indicated against each.</p>
                                    <div class="row">
                                        <div class="col-sm-12" style="overflow-x: scroll;">
                                            <table class="table table-striped table-bordered table-hover responsive" id="failed_records_table">
                                                <thead>
                                                <tr>
                                                    @foreach($csvHeading as $h)
                                                        <td>{{ $h }}</td>
                                                    @endforeach
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($failedRecords as $record)
                                                    <tr>
                                                        @foreach($record as $key => $cell)
                                                            {{--@if ($key != -1)--}}
                                                            @if($key == "failReason")
                                                                <td class="all">{{ $cell }}</td>
                                                            @else
                                                                <td>{{ $cell }}</td>
                                                            @endif
                                                            {{--@endif--}}
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->

    </div>
@stop

@section('footer')
    {!!  HTML::script("admin/global/plugins/datatables/datatables.min.js") !!}
    {!!  HTML::script("admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}
    {!!  HTML::script("admin/global/plugins/datatables/plugins/responsive/dataTables.responsive.js") !!}
    {!!  HTML::script("admin/global/plugins/datatables/plugins/responsive/responsive.bootstrap.js") !!}

    <script type="text/javascript">
        var table = $('#failed_records_table').dataTable({
            "bProcessing": true,
            "autoWidth": false,
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "sPaginationType": "full_numbers",
            "fnInitComplete": function() {
                $(".dataTables_length").addClass("hidden-xs");
                $(this).removeClass("hidden");
            }
        });
    </script>


@stop