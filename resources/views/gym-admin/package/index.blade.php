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
                <span>Package</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet light portlet-fit">
                        <div class="portlet-title col-xs-12">
                            <div class="caption col-sm-10 col-xs-12">
                                <i class="icon-present font-red"></i><span class="caption-subject font-red bold uppercase">Packages</span>
                            </div>

                            <div class="actions col-sm-2 col-xs-12">

                                <a href="{{ route('gym-admin.package.create') }}" class="btn dark"> add <span class="hidden-xs">package</span>
                                    <i class="fa fa-plus"></i>
                                </a>

                            </div>

                        </div>
                        <div class="portlet-body">

                            <div class="row">

                                @foreach($packages as $key=>$pkg)
                                    <div id="pkg-{{ $pkg->id }}" class="col-md-6 col-xs-12">
                                    <!-- BEGIN Portlet PORTLET-->
                                    <div class="portlet solid grey-cararra">
                                        <div class="portlet-title ">
                                            <div class="caption col-md-6 col-xs-12">
                                                <i class="fa fa-gift"></i>{{ ucwords($pkg->title) }}
                                            </div>
                                            <div class="actions col-md-6 col-xs-12">
                                                <div class="btn-group">
                                                    <span class="btn btn-sm green btn-circle">
                                                        {{ $pkg->package_for }}
                                                    </span>
                                                </div>
                                                <div class="btn-group">
                                                    <a class="btn btn-sm red btn-circle">
                                                        <i class="fa fa-rupee"></i>{{ number_format($pkg->price) }}
                                                    </a>
                                                </div>

                                                <div class="btn-group">
                                                    <a class="btn blue-hoki btn-sm btn-circle" href="javascript:;" data-toggle="dropdown">
                                                        <i class="fa fa-gear"></i> <span class="hidden-xs">Action</span>
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="{{ route('gym-admin.package.edit',$pkg->id) }}">
                                                                <i class="fa fa-pencil"></i> Edit </a>
                                                        </li>
                                                        <li>
                                                            <a data-package-id="{{ $pkg->id }}" class="delete-button" href="javascript:;">
                                                                <i class="fa fa-trash-o"></i> Delete </a>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="scroller" style="height:200px">
                                            {{ $pkg->details }}
                                                </div>
                                        </div>
                                    </div>
                                    <!-- END GRID PORTLET-->
                                </div>
                                @endforeach
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

