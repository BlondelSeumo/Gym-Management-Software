{!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <span class="caption-subject font-red-sunglo bold uppercase"><i class="icon-pencil"></i> Assign Role</span>
</div>
<div class="modal-body">

    <div class="portlet-body">
        {!! Form::open(['id'=>'storePayments','class'=>'ajax-form form-horizontal','method'=>'POST']) !!}
        <div class="row">
            <div class="col-md-12">

                <div class="form-body">
                    <div class="form-group form-md-line-input row">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-9">
                            <div class="form-control form-control-static">
                                {{ ucwords($user->first_name.' '.$user->last_name) }}
                            </div>

                        </div>
                    </div>
                    <div class="form-group row form-md-line-input">
                        <label class="col-md-3 control-label">Role</label>
                        <div class="col-md-9">
                            <div class="form-control form-control-static">
                                <select  class="bs-select form-control" data-live-search="true" data-size="8" name="role_id" id="role_id">
                                    <option value="">Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" >{{ucfirst($role->name)}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
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
                <button  type="button" id="save-form" class="btn green">Submit</button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
{!! HTML::script('admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
{!! HTML::script('admin/pages/scripts/components-bootstrap-select.min.js') !!}

<script>
    $('#save-form').click(function(){

        var show_url = '{{route('gym-admin.users.assign-role-store',['#id'])}}';
        var url = show_url.replace('#id', '{{ $user->id }}');

        $.easyAjax({
            url: url,
            container:'#storePayments',
            type: "POST",
            data:$('#storePayments').serialize(),
            formReset:true,
            success:function(response){
                if(response.status == 'success'){
                    $('#reminderModal').modal('hide');
                    load_dataTable();
                }
            }
        })
    });
</script>