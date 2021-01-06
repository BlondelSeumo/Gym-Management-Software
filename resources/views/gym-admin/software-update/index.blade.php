@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
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
                <span>New Updates</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->



        <div class="page-content-inner">
            <div class="row">
                <div class=" col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="fa fa-magic font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> New Updates</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="timeline">
                                <!-- TIMELINE ITEM -->
                                @if($UpcomingInfo =='')
                                    @else
                                @foreach($UpcomingInfo as $info)
                                <div class="timeline-item">
                                    <div class="timeline-badge">
                                        <div class="timeline-icon bg-green sbold bg-font-green border-grey-steel">

                                            {{ $info->date->format('d M') }}
                                        </div>
                                    </div>
                                    <div class="timeline-body">
                                        <div class="timeline-body-arrow"> </div>
                                        <div class="timeline-body-head">
                                            <div class="timeline-body-head-caption">
                                                <span class="timeline-body-alerttitle font-black-intense">{{ucwords($info->title)}}</span>
                                                <span class="timeline-body-time font-grey-cascade">{{$info->date->toFormattedDateString()}}</span>
                                            </div>
                                        </div>
                                        <div class="timeline-body-content">
                                                            <span class="font-grey-cascade"> {!!  $info->details !!}
                                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- END TIMELINE ITEM -->
                                @endforeach
                                @endif

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
    {!! HTML::script('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
    <script>

    </script>
@stop