<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <span class="caption-subject font-red-sunglo bold uppercase">Add New Custom Payment Type</span>
</div>
<div class="modal-body">
    <div class="portlet-body">
        {!! Form::open(['id'=>'gym-custom_type_data','class'=>'ajax-form','method'=>'POST']) !!}
        <div class="row">
            <div class="col-md-12">

                <div class="form-body">
                    <div class="form-group row">
                        <label class="col-md-3 control-label">Type Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Offer Title" name="name" id="name">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="modal-footer">
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-3 col-md-9">
                <button  type="button" id="save-form" class="btn green">Submit</button>
                <button type="button" class="btn default">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#save-form').click(function () {
        $.easyAjax({
            url:'{{route('gym-admin.custom-type.store')}}',
            container:'.modal-body',
            type:'Post',
            data:$('#gym-custom_type_data').serialize()
        })
    })
</script>