@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
{!! HTML::style('admin/pages/css/blog.min.css') !!}
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
                <span>Feedback</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">

            <div class="row widget-row">
                <div class="col-md-3">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                        <h4 class="widget-thumb-heading">Total Reviews</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-green icon-star"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">Count</span>
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ $totalReviews }}">{{ $totalReviews }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-star font-red"></i>
                                <span class="caption-subject font-red bold uppercase"> user feedback</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="blog-comments">
                                <div class="c-comment-list">
                                    @foreach($reviews as $review)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="media">
                                        <div class="media-left">
                                            @if($review->user->profile_image != "")
                                                {!! HTML::image($profilePath.$review->user->profile_image, '',array("class" => "item-pic")) !!}
                                            @else
                                                {!! HTML::image($profilePath.'user.svg', '',array("class" => "item-pic")) !!}
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="#">{{ ucwords($review->user->first_name." ".$review->user->last_name) }}</a>
                                                <span class="c-date">{{ $review->created_at->diffForHumans() }}</span>
                                            </h4> {!! nl2br($review->review_text) !!}
                                        </div>
                                    </div>
                                        </div>
                                    </div>
                                        <div class="row" style="margin-top: 15px;margin-bottom: 15px">
                                            <div class="col-md-1 col-xs-4">
                                                <a href="javascript:;" class="btn btn-xs red"  onclick="loadComments({{$review->id}})">
                                                    Comments <i class="fa fa-comment"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-1 col-xs-4" style="margin-left: 10px">
                                                <a href="javascript:;" class="btn btn-xs blue" onclick="ShowReply({{$review->id}})">
                                                    Reply <i class="fa fa-comments"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12" id="replyResponce_{{$review->id}}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-xs-12" id="reply">
                                            </div>
                                        </div>
                                        <div id="ReplyRow_{{$review->id}}" class="row" style="display: none;margin-bottom: 15px">
                                            <div class="col-md-5 col-md-offset-2">
                                                <div id="replyBox">
                                                    <textarea class="form-control" name="reply" id="reply_{{$review->id}}"></textarea>
                                                    <br>
                                                    <button class="btn btn-default" onclick="HideReply({{$review->id}})"><i class="fa fa-close"></i> &nbsp;Cancel</button>
                                                    <button class="btn btn-success" onclick="PostReply({{$review->id}})"><i class="fa fa-check"></i> &nbsp;Post</button>
                                                </div>
                                            </div>
                                        </div>




                                        <div id="commentsRow" class="row">
                                            <div class="col-md-11 col-md-offset-1">
                                                <div id="showComments_{{$review->id}}" rel="0">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-offset-4 col-md-1">
                                                        <button class="btn btn-default loadMore" id="loadMore_{{$review->id}}" onclick="loadMore('{{$review->id}}',total,count)">Load More</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>


    <div class="modal fade bs-modal-md in" id="gymReplyModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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



@stop

@section('footer')
    {!! HTML::script('admin/global/plugins/counterup/jquery.counterup.js') !!}
    {!! HTML::script('admin/global/plugins/counterup/jquery.waypoints.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootbox/bootbox.min.js') !!}

    <script>
        var total = 0;
        var count = 0;
        jQuery(document).ready(function() {
            $('.loadMore').css('display','none');


        });
    </script>
    <script>
        function loadComments(id)
        {
            var commentsDiv = $('#showComments_'+id);
            if(commentsDiv.attr('rel') == '0'){
                $.ajax({
                    type: 'post',
                    url: '{{route('gym-admin.feedback.load.comments')}}',
                    data: {id:id,_token:'{{csrf_token()}}'},
                    beforeSend: function () {
                    },
                    success: function (data) {
                        commentsDiv.html(data);
                        if(parseInt(total)>(parseInt(count)))
                        {
                            $('#loadMore_'+id).css('display','');
                        }else
                        {
                            $('#loadMore_'+id).css('display','none');
                        }
                    },
                    error: function (xhr, textStatus, thrownError) {
                        alert('Something went wrong. Please try again!');
                    }
                });
                commentsDiv.attr('rel','1');
            }else
            {
                commentsDiv.html('');
                commentsDiv.attr('rel','0');
                $('#loadMore_'+id).css('display','none');
            }
        }

        function ShowReply(id)
        {
            $('#ReplyRow_'+id).css('display','');
        }
        function HideReply(id){

            $('#ReplyRow_'+id).css('display','none');
            $('#replyResponce_'+id).html('');
        }

        function PostReply(id)
        {
            var reply = $('#reply_'+id).val();
            $.ajax({
                type: 'post',
                url: '{{route('gym-admin.feedback.reply.store')}}',
                data: {reply:reply,id:id,_token:'{{csrf_token()}}'},
                beforeSend: function () {
                },
                success: function (data) {
                    var res = JSON.parse(data);

                    $('#replyResponce_'+id).html('<div class="'+res.class+'">'+res.error+'</div>');
                    if(res.success == true)
                    {
                        $('#ReplyRow_'+id).css('display','none');
                        setTimeout(function(){ $('#replyResponce_'+id).html(''); }, 3000);
                    }
                },
                error: function (xhr, textStatus, thrownError) {
                    alert('Something went wrong. Please try again!');
                }
            });
        }

        function loadMore(id,take,skip)
        {
            var commentsDiv = $('#showComments_'+id);
            $.ajax({
                type: 'post',
                url: '{{route('gym-admin.feedback.more.comments')}}',
                data: {id:id,take:take,skip:skip,_token:'{{csrf_token()}}'},
                beforeSend: function () {
                },
                success: function (data) {
                    commentsDiv.append(data);
                    $('#loadMore_'+id).css('display','none');
                },
                error: function (xhr, textStatus, thrownError) {
                    alert('Something went wrong. Please try again!');
                }
            });
        }


        function HideEdit(id){

            $('#replyEdit_'+id).css('display','none');
            $('#reply_'+id).html('');
        }
        function deleteModal(id){
            var url_modal = '{{route('gym-admin.remove.reply',[':id'])}}';
            var url = url_modal.replace(':id',id);
            $('#modelHeading').html('Remove Reply');
            $.ajaxModal("#gymReplyModal", url);
        }

        function showEdit(comment,id)
        {
            $('#replyEdit_'+id).css('display','block');

        }
        function editReply(id) {
            var reply = $('#reply_'+id).val();
            $.ajax({
                type: 'post',
                url: '{{route('gym-admin.feedback.edit')}}',
                data: {reply:reply,id:id,_token:'{{csrf_token()}}'},
                beforeSend: function () {
                },
                success: function (data) {
                    var res = JSON.parse(data);

                   $('#reply').html('<div class="'+res.class+'">'+res.error+'</div>');
                    if(res.success == true)
                    {
                        $('#replyEdit_'+id).css('display','none');
                        setTimeout(function(){ $('#reply').html(''); }, 3000);
                    }
                },
                error: function (xhr, textStatus, thrownError) {
                    alert('Something went wrong. Please try again!');
                }
            });

        }
    </script>

@stop