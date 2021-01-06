@extends('gym-admin.message.index')
@section('inbox')
<div class="inbox-header">
    <h1 class="pull-left">Inbox</h1>
</div>
<div class="inbox-content">
    <table class="table table-striped table-advance table-hover">
        {{--<thead>--}}
        {{--<tr>--}}
            {{--<th colspan="3">--}}
                {{--<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">--}}
                    {{--<input type="checkbox" class="mail-group-checkbox" />--}}
                    {{--<span></span>--}}
                {{--</label>--}}
                {{--<div class="btn-group input-actions">--}}
                    {{--<a class="btn btn-sm blue btn-outline dropdown-toggle sbold" href="javascript:;" data-toggle="dropdown"> Actions--}}
                        {{--<i class="fa fa-angle-down"></i>--}}
                    {{--</a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li>--}}
                            {{--<a href="javascript:;">--}}
                                {{--<i class="fa fa-pencil"></i> Mark as Read </a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="javascript:;">--}}
                                {{--<i class="fa fa-ban"></i> Spam </a>--}}
                        {{--</li>--}}
                        {{--<li class="divider"> </li>--}}
                        {{--<li>--}}
                            {{--<a href="javascript:;">--}}
                                {{--<i class="fa fa-trash-o"></i> Delete </a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</th>--}}
            {{--<th class="pagination-control" colspan="3">--}}
                {{--<span class="pagination-info"> 1-30 of 789 </span>--}}
                {{--<a class="btn btn-sm blue btn-outline">--}}
                    {{--<i class="fa fa-angle-left"></i>--}}
                {{--</a>--}}
                {{--<a class="btn btn-sm blue btn-outline">--}}
                    {{--<i class="fa fa-angle-right"></i>--}}
                {{--</a>--}}
            {{--</th>--}}
        {{--</tr>--}}
        {{--</thead>--}}
        <tbody>
        @foreach($messages as $message)
            <tr @if(isset($unreadMessages) && $unreadMessages > 0 && $message->mark_as == 'unread') class="unread" @endif data-messageid="{{ $message->thread_id }}">
                {{--<td class="inbox-small-cells">--}}
                    {{--<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">--}}
                        {{--<input type="checkbox" class="mail-checkbox" value="1" />--}}
                        {{--<span></span>--}}
                    {{--</label>--}}
                {{--</td>--}}
                <td class="view-message hidden-xs"> {{ $message->client->first_name.' '.$message->client->last_name }} </td>
                <td class="view-message "> {{ substr($message->text, 0, 80) }}... </td>
                <td class="view-message inbox-small-cells">
                    <i class="fa fa-paperclip"></i>
                </td>
                <td class="view-message text-right"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $message->created_at)->diffForHumans() }} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('detail-scripts')
    <script>
        $('tr').on('click', function () {
            var threadId = $(this).data('messageid');
            var url = "{{ route('gym-admin.message.show', ['#id']) }}";
            url = url.replace('#id', threadId);
            window.location = url;
        });
    </script>
@endpush