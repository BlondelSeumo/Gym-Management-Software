@extends('layouts.customer-app.basic')

@section('title')
    Fitsigma | Customer Mail Detail
@endsection

@section('CSS')
{!! HTML::style('fitsigma_customer/bower_components/html5-editor/bootstrap-wysihtml5.css') !!}
<style>
    .padding-button {
        padding-left: 22px;
    }
    .margin-bottom-compose {
        margin-bottom: 18px;
    }
</style>
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Mail Detail</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Main Menu</li>
                <li class="active">Mail Detail</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="chat-main-box">
        <!-- .chat-left-panel -->
        <div class="chat-left-aside">
            <div class="open-panel"><i class="ti-angle-right"></i></div>
            <div class="chat-left-inner inbox-panel">
                <div class="">
                    <div class="list-group mail-list m-t-20 padding-button">
                        <a href="{{ route('customer-app.message.create') }}" class="btn btn-custom btn-block waves-effect waves-light margin-bottom-compose compose-mail">Compose</a>
                        <a href="{{ route('customer-app.message.index') }}" class="list-group-item active">Inbox <span class="label label-rouded label-success pull-right">@if($unreadMessages > 0) {{ $unreadMessages }} @endif</span></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- .chat-left-panel -->
        <!-- .chat-right-panel -->
        <div class="chat-right-aside">
            <div class="chat-main-header">
                <div class="p-20 b-b">
                    <h3 class="box-title">Chat Message</h3>
                </div>
            </div>
            <div class="chat-box">
                <ul class="chat-list slimscroll p-t-30" id="message-chat">
                    @foreach($messages as $message)
                        <li @if($message->to == 'merchant') class="odd" @endif>
                            <div class="chat-body">
                                <div class="chat-text">
                                    <h4>@if($message->to == 'merchant') {{ $message->client->first_name.' '.$message->client->last_name }} @else {{ $message->merchant->first_name.' '.$message->merchant->last_name }} @endif</h4>
                                    <p> {!! nl2br($message->text) !!} </p>
                                    <b>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $message->created_at)->diffForHumans() }}</b> </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="row send-chat-box">
                    <div class="col-sm-12">
                        <textarea class="form-control" id="message" placeholder="Type your message"></textarea>
                        <div class="custom-send">
                            <button class="btn btn-danger btn-rounded" id="sendMail" type="button">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .chat-right-panel -->
    </div>
@endsection

@section('JS')
{!! HTML::script('fitsigma_customer/js/chat.js') !!}
{!! HTML::script('fitsigma_customer/js/jquery.slimscroll.js') !!}
{!! HTML::script('fitsigma_customer/bower_components/html5-editor/wysihtml5-0.3.0.js') !!}
{!! HTML::script('fitsigma_customer/bower_components/html5-editor/bootstrap-wysihtml5.js') !!}
    <script>
        $(function () {
            $('.chat-list').animate({
                scrollTop: $('.chat-box li:last-child').position().top
            }, 'slow');
        });

        $('#sendMail').on('click', function () {
            var message = $('#message').val();
            var url = window.location.pathname;
            var id = url.substring(url.lastIndexOf('/') + 1);
            var updateUrl = '{{ route('customer-app.message.update', ['#id']) }}';
            var finalUrl = updateUrl.replace('#id', id);
            $.easyAjax({
                type: 'PUT',
                url: finalUrl,
                data: {
                    message: message
                },
                success: function (response) {
                    var str = '<li class="odd">'+
                                    '<div class="chat-body">'+
                                        '<div class="chat-text">'+
                                        '<h4>{{ $customerValues->first_name.' '.$customerValues->last_name }}</h4>'+
                                        '<p>' + response.message + '</p>'+
                                        '<b>few seconds ago</b> </div>'+
                                    '</div>'+
                                '</li>';
                    $( ".chat-list" ).append(str);
                    $('#message').val('');
                    $('.chat-list').stop().animate({
                        scrollTop: $(".chat-list")[0].scrollHeight
                    }, 800);
                }
            });
        });

        $('.compose-mail').on('click', function (event) {
            event.preventDefault();
            var url = '{{ route('customer-app.message.create') }}';
            $.ajaxModal('#customerShowModal', url);
        });
    </script>
@endsection