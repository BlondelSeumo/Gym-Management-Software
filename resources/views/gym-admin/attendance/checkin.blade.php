<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <span class="caption-subject font-red-sunglo bold uppercase"><i class="font-red fa fa-clock-o"></i> Select Time</span>
</div>
<div class="modal-body tabbable-line">
    <div class="portlet-body">
        {!! Form::open(['id'=>'gym-offer_data','class'=>'ajax-form','method'=>'POST']) !!}
        <div class="tab-content">
            <div class="tab-pane active" id="portlet_tab1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-md-2 control-label ">Time</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control timepicker timepicker-default">
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</div>
<hr>
<div class="modal-footer">
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-3 col-md-9">
                <button  type="button" id="checkin_submit" class="btn green">Submit</button>
                <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.timepicker-default').timepicker({
        autoclose: true,
        minuteStep: 1
    });
    $('#checkin_submit').click(function(){
        var attendance = $('#attendance-date').val()+' '+$('.timepicker-default').val();
        $.easyAjax({
            url: '{{ route("gym-admin.attendance.markAttendance") }}',
            type: "POST",
            data: {clientId: '{{$id}}',date: attendance,'_token': '{{ csrf_token() }}'},
            success: function(response){
                $("#attendenceModal").modal("hide");
                writeCheckOut('{{$id}}',attendance,response.id);
                dTable.init();
            }
        });
    });

</script>
