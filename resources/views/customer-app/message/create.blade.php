<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title" id="myLargeModalLabel">Compose Message</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        {!! Form::open(['route'=>'customer-app.message.store','id'=>'composeMailForm','class'=>'ajax-form form-material form-horizontal','method'=>'POST']) !!}
            <div class="form-group">
                <label class="col-sm-12">Choose Member</label>
                <div class="col-sm-12">
                    <select class="form-control select2" name="admin_id" id="admin_id">
                        <option selected disabled>Select Member</option>
                        @foreach($admins as $admin)
                            <option value="{{ $admin->id }}">{{ $admin->first_name.' '.$admin->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <textarea class="textarea_editor form-control" rows="15" placeholder="Enter text ..."></textarea>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<hr>
<div class="modal-footer">
    <button type="button" id="send-mail" class="btn btn-success">Send</button>
    <button type="button" class="btn default" data-dismiss="modal">Close</button>
</div>
<script>
    $(function() {
        $('.textarea_editor').wysihtml5();
    });

    $('#send-mail').on('click', function () {
        var text = $('.textarea_editor').val();
        var admin_id = $('#admin_id').val();
        $.easyAjax({
            type: 'POST',
            url: '{{ route('customer-app.message.store') }}',
            data: {
                text: text,
                admin_id: admin_id
            },
            success: function (response) {
                $('#customerShowModal').modal("hide");
            }
        });
    });
</script>