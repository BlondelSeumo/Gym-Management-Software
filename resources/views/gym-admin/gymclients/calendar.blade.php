@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/fullcalendar/fullcalendar.css') !!}
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
                <a href="{{route('gym-admin.client.index')}}">Clients</a>
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
                    <div class="portlet light portlet-fit  calendar">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">Calendar</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="mt-element-card mt-element-overlay">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 ">
                                        <div class="mt-card-item">
                                            <div class="mt-card-avatar mt-overlay-1">
                                                @if($client->image == '')
                                                    <img src="{{asset('/fitsigma/images/').'/'.'user.svg'}}" />
                                                @else
                                                    @if($gymSettings->local_storage == '0')
                                                        <img src="{{$profileHeaderPath.$client->image}}"  />
                                                    @else
                                                        <img src="{{asset('/uploads/profile_pic/master/').'/'.$client->image}}" />
                                                    @endif
                                                @endif
                                                <div class="mt-overlay">
                                                    <ul class="mt-info">
                                                        <li>
                                                            <a class="btn default btn-outline" href="{{route('gym-admin.client.show',$client->id)}}">
                                                                <i class="icon-link"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="mt-card-content">
                                                <h3 class="mt-card-name">{{$client->first_name}}&nbsp;{{$client->last_name}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-12">
                                        <div id="attendance" class="has-toolbar"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>


    {{--End Modal--}}
@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/moment.min.js') !!}
    {!! HTML::script('admin/global/plugins/fullcalendar/fullcalendar.min.js') !!}
    {!! HTML::script('admin/global/plugins/jquery-ui/jquery-ui.min.js') !!}
    {!! HTML::script('admin/apps/scripts/calendar.js') !!}

    <script>

        var h = {};

        if (App.isRTL()) {
            if ($('#attendance').parents(".portlet").width() <= 720) {
                $('#attendance').addClass("mobile");
                h = {
                    right: 'title, prev, next',
                    center: '',
                    left: 'month'
                };
            } else {
                $('#attendance').removeClass("mobile");
                h = {
                    right: 'title',
                    center: '',
                    left: 'month, prev,next'
                };
            }
        } else {
            if ($('#attendance').parents(".portlet").width() <= 720) {
                $('#attendance').addClass("mobile");
                h = {
                    left: 'title, prev, next',
                    center: '',
                    right: ''
                };
            } else {
                $('#attendance').removeClass("mobile");
                h = {
                    left: 'title',
                    center: '',
                    right: 'prev,next,month'
                };
            }
        }

        $('#attendance').fullCalendar({ //re-initialize the calendar
            header: h,
            defaultView: 'month', // change default view with available options from http://arshaw.com/fullcalendar/docs/views/Available_Views/
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            events: [
            @foreach($attendance as $att)
                {
                    title: "Present",
                    start: new Date('{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$att->check_in)->format('F M d Y H:i:s ')}} GMT+0530 (IST)'),
                    end: new Date('{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$att->check_in)->format('F M d Y H:i:s ')}} GMT+0530 (IST)'),
                    backgroundColor: App.getBrandColor('blue')
                },
            @endforeach
            ]
        });
    </script>
    <script>
    </script>
@stop