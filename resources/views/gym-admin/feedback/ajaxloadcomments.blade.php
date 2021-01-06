@if(count($comments)>0)
    @foreach($comments as $comment)
        <div class="media">
            <div class="media-left">
                    @if($comment->user)
                        @if($comment->user->profile_image != "")
                            {!! HTML::image($profilePath.$comment->user->profile_image) !!}
                        @else
                            {!! HTML::image($profilePath.'user.png') !!}
                        @endif
                    @endif
            </div>
            <div class="media-body">
                <h4 class="media-heading">
                    @if($comment->user)
                        <a href="{{ URL::to('user/profile/'.$comment->user->id) }}">{{ $comment->user->first_name }} {{ $comment->user->last_name }}</a>
                    @else
                        <a href="javascript:;">Owner</a>
                    @endif

                    <span class="c-date">{{ $comment->created_at->diffForHumans() }}</span>
                </h4> {!! nl2br($comment->comment) !!}</br>
                <a href="javascript:;" onclick="showEdit('{{$comment->comment}}',{{$comment->id}})">  Edit</a>
                <a href="javascript:;" onClick="deleteModal({{$comment->id}})">  Remove</a>
                <div id="replyEdit_{{$comment->id}}" style="display: none;margin-bottom: 15px; width: 50%">
                <textarea class="form-control" name="reply" id="reply_{{$comment->id}}">{{$comment->comment}}</textarea>
                   </br>
                    <button class="btn btn-default" onclick="HideEdit({{$comment->id}})"><i class="fa fa-close"></i> &nbsp;Cancel</button>
                    <button class="btn btn-success" onclick="editReply({{$comment->id}})"><i class="fa fa-check"></i> &nbsp;Post</button>

                </div>
            </div>


        </div>
    @endforeach
@else
    <hr>
    <p>No Comments</p>
    <hr>
@endif
<script>
    total = '{{$total}}';
    count = '{{$count}}';

</script>