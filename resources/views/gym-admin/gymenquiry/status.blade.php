<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <span class="caption-subject font-red-sunglo bold uppercase">Change Status</span>
</div>
<div class="modal-body">
    {!! Form::open(['id'=>'changeStatusForm','class'=>'ajax-form']) !!}
    <div class="row">
        <div class="col-md-12">

            <div class="form-group">
                <label class="control-label">Status</label>
                <select class="form-control" name="status">
                    <option value="pending" @if($enquiry->status == 'pending')selected @endif>Pending</option>
                    <option value="in_process" @if($enquiry->status == 'in_process')selected @endif>In Process</option>
                    <option value="resolved" @if($enquiry->status == 'resolved')selected @endif>Resolved</option>
                </select>
            </div>
            <input type="hidden" name="id" value="{{$enquiry->id}}">
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:;" class="btn blue" id="statusChange" >Change</a>
    </div>
    {!! Form::close() !!}
</div>

<script>
    $('#statusChange').click(function(){
        $.easyAjax({
            url: '{{route('gym-admin.enquiry.status')}}',
            container:'#changeStatusForm',
            type: "POST",
            data:$('#changeStatusForm').serialize()
        })
    });
</script>
