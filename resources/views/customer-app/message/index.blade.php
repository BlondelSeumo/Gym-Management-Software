@extends('layouts.customer-app.basic')

@section('title')
    Fitsigma | Customer Message
@endsection

@section('CSS')
{!! HTML::style('fitsigma_customer/bower_components/html5-editor/bootstrap-wysihtml5.css') !!}
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Message</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Main Menu</li>
                <li class="active">Message</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <!-- Left sidebar -->
        <div class="col-md-12">
            <div class="white-box">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-2 col-md-3  col-sm-12 col-xs-12 inbox-panel">
                        <div> <a href="javascript:;" class="btn btn-custom btn-block waves-effect waves-light compose-mail">Compose</a>
                            <div class="list-group mail-list m-t-20"> <a href="javascript:;" class="list-group-item active">Inbox <span class="label label-rouded label-success pull-right">@if(isset($unreadMessages) && $unreadMessages > 0) {{ $unreadMessages }} @endif</span></a>  </div>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-9 col-sm-12 col-xs-12 mail_listing">
                        <div class="inbox-center">
                            <table class="table table-hover">
                                <tbody>
                                @foreach($messages as $message)
                                    <tr @if(isset($unreadMessages) && $unreadMessages > 0 && $message->mark_as == 'unread')class="unread"@endif>
                                        <td class="hidden-xs">{{ $message->merchant->first_name }}</td>
                                        <td class="max-texts"> <a href="{{ route('customer-app.message.show', [$message->thread_id]) }}" /><!--<span class="label label-info m-r-10">Work</span>-->{{ substr($message->text, 0, 80) }}... </td>
                                        </td>
                                        <td class="text-right"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $message->created_at)->diffForHumans() }} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>
@endsection

@section('JS')
    {!! HTML::script('fitsigma_customer/bower_components/html5-editor/wysihtml5-0.3.0.js') !!}
    {!! HTML::script('fitsigma_customer/bower_components/html5-editor/bootstrap-wysihtml5.js') !!}
<script>
    $('.compose-mail').on('click', function () {
        var url = '{{ route('customer-app.message.create') }}';
        $.ajaxModal('#customerShowModal', url);
    });
</script>
@endsection