@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/apps/css/inbox.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') !!}
    <style>
        .padding-bottom-select {
            padding-bottom: 60px;
        }
    </style>
    @stack('show-styles')
@stop

@section('content')
    <div class="page-container">
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <!-- BEGIN PAGE HEAD-->
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE CONTENT BODY -->
            <div class="page-content">
                <div class="container">
                    <!-- BEGIN PAGE BREADCRUMBS -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="{{ route('gym-admin.dashboard.index') }}">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <a href="javascript:;">Message</a>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMBS -->
                    <!-- BEGIN PAGE CONTENT INNER -->
                    <div class="page-content-inner">
                        <div class="inbox">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="inbox-sidebar">
                                        <a href="javascript:;" data-title="Compose" class="btn red compose-btn btn-block compose-message">
                                            <i class="fa fa-edit"></i> Compose </a>
                                        <ul class="inbox-nav">
                                            <li class="{{ $inboxActive or '' }}">
                                                <a href="{{ route('gym-admin.message.index') }}" data-type="inbox" data-title="Inbox">Inbox
                                                    <span class="badge badge-success">@if(isset($unreadMessages) && $unreadMessages > 0) {{ $unreadMessages }} @endif</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="inbox-body">
                                        @yield('inbox')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE CONTENT INNER -->
                </div>
            </div>
            <!-- END PAGE CONTENT BODY -->
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
@stop

@section('modal')
    <div id="mailModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Responsive & Scrollable</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                    <button type="button" class="btn green">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @stack('detail-scripts')
    @stack('show-scripts')
    {!! HTML::script('admin/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') !!}
    <script>

        $('.compose-message').on('click', function() {
            var url = '{{ route('gym-admin.message.create') }}';
            $.ajaxModal('#mailModal', url);
        });

    </script>
@stop