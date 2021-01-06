@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
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
                <span>Fitsigma Tutorials</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">

                @foreach($tutorials as $tut)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="portlet light portlet-fit ">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-green bold uppercase">{{ ucwords($tut->title) }}</span>
                                <div class="caption-desc font-grey-cascade">{{ ucfirst($tut->description) }}</div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="mt-element-overlay">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mt-overlay-3">
                                            <img src="{{ asset('admin/admin/pages/img/ace-tut.jpg') }}" />
                                            <div class="mt-overlay">
                                                <h2>{{ ucwords($tut->title) }}</h2>
                                                <a class="mt-info watch-tutorial" href="javascript:;" data-video-id="{{ $tut->id }}"><i class="fa fa-play"></i> Watch Video</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
@stop