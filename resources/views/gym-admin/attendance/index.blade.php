@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/datatables/datatables.min.css') !!}
    {!! HTML::style('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
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
                <span>Attendance</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet light portlet-fit">
                        <div class="portlet-title col-xs-12">
                            <div class="caption col-sm-9 col-xs-12">
                                <div class="col-sm-4 col-xs-12">
                                    <i class="icon-users font-red"></i> <span class="caption-subject font-red bold uppercase">Attendance</span>
                                </div>



                            </div>

                            <div class="actions col-sm-3 col-xs-12">

                                <div class="btn-group">
                                    <button class="btn  dark" type="button">TODAY</button>
                                    <button class="btn red" type="button">WEEK</button>
                                    <button class="btn dark" type="button">MONTH</button>
                                    <button class="btn dark" type="button">YEAR</button>
                                </div>

                            </div>

                        </div>
                        <div class="portlet-body">

                            <div class="row">

                                <div class="col-xs-12">

                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/bootbox/bootbox.min.js') !!}
    <script>
        var UIBootbox = function () {
            var o = function () {
                $(".delete-button").click(function () {
                    var memID = $(this).data('package-id');

                    bootbox.confirm({
                        message: "Do you want to delete this package?",
                        buttons: {
                            confirm: {
                                label: "Yes",
                                className: "btn-primary"
                            }
                        },
                        callback: function(result){
                            if(result){

                                var url = '{{route('gym-admin.package.destroy',':id')}}';
                                url = url.replace(':id',memID);

                                $.easyAjax({
                                    url: url,
                                    type: "DELETE",
                                    data: {memID: memID,_token: '{{ csrf_token() }}'},
                                    success: function(){
                                        $('#pkg-'+memID).fadeOut();
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
        });
    </script>
@stop

