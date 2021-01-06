@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}

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
                <span>Take Backup</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="fa fa-cloud-download font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> Take Backup</span>
                            </div>
                        </div>

                        @if(Session::has('flash_message'))
                            hello
                        @endif
                        <div class="portlet-body">

                            <ul class="list-group">
                                <li class="list-group-item"> Customers Backup
                                    <a href="{{route('gym-admin.backup.getbackup',['customer'])}}">
                                    <button type="button" id="customer" style="float: right; padding: 2px 9px 2px;" data-loading-text="Loading..." class="btn blue mt-ladda-btn  ladda-button mt-progress-demo" data-style="slide-left">
                                        <span class="ladda-label" id="customerText"><i class="icon-cloud-download"></i> Download</span>
                                    </button></a>
                                </li>
                                <li class="list-group-item"> Subscriptions Backup
                                    <a href="{{route('gym-admin.backup.getbackup',['subscriptions'])}}">
                                    <button type="button" id ="subscriptions"style="float: right; padding: 2px 9px 2px;" data-loading-text="Loading..." class="btn blue mt-ladda-btn  ladda-button mt-progress-demo" data-style="slide-left">
                                        <span class="ladda-label" id="subscriptionsText"><i class="icon-cloud-download"></i> Download</span>
                                    </button></a>
                                </li>
                                <li class="list-group-item"> Memberships Backup
                                    <a href="{{route('gym-admin.backup.getbackup',['membership'])}}">
                                    <button type="button" id="membership" style="float: right; padding: 2px 9px 2px;" data-loading-text="Loading..." class="btn blue mt-ladda-btn  ladda-button mt-progress-demo" data-style="slide-left">
                                        <span class="ladda-label" id="membershipText"><i class="icon-cloud-download"></i> Download</span>
                                    </button></a>
                                </li>
                                <li class="list-group-item"> Attendance Backup
                                    <a href="{{route('gym-admin.backup.getbackup',['attendance'])}}">
                                    <button type="button" id="attendance" style="float: right; padding: 2px 9px 2px;" data-loading-text="Loading..." class=" btn blue mt-ladda-btn  ladda-button mt-progress-demo" data-style="slide-left">
                                        <span class="  ladda-label" id="attendanceText"><i class="icon-cloud-download"></i> Download</span>
                                    </button></a>
                                </li>
                                <li class="list-group-item"> Enquiries Backup
                                    <a href="{{route('gym-admin.backup.getbackup',['enquiries'])}}">
                                    <button type="button" id="enquiries" style="float: right; padding: 2px 9px 2px;" data-loading-text="Loading..." class=" btn blue mt-ladda-btn  ladda-button mt-progress-demo" data-style="slide-left">
                                        <span class="  ladda-label" id="enquiriesText"><i class="icon-cloud-download"></i> Download</span>
                                    </button></a>
                                </li>
                                <li class="list-group-item"> Payments Backup
                                    <a href="{{route('gym-admin.backup.getbackup',['payments'])}}">
                                    <button type="button" id="payments" style="float: right; padding: 2px 9px 2px;" data-loading-text="Loading..." class=" btn blue mt-ladda-btn  ladda-button mt-progress-demo" data-style="slide-left">
                                          <span class="  ladda-label " id="paymentsText"><i class="icon-cloud-download"></i> Download</span>
                                    </button></a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
    {!! HTML::script('admin/pages/scripts/ui-buttons.min.js') !!}



@stop