<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <span class="caption-subject font-red bold uppercase"><i class="font-red fa fa-send"></i> Send renew subscription reminder to {{$client_data->first_name.' '.$client_data->last_name}}</span>
</div>
<div class="modal-body tabbable-line">
    <div class="portlet-body">
        <form action="#" class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                    <div class="col-md-12">
                        <label class="control-label">Membership to renew: </label>

                        <p class="form-control-static">
                            {{ $client_data->membership }}
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <label class="control-label">Send Reminder via: </label>

                        <p class="form-control-static">
                            <label for="sms_reminder"><input type="checkbox" checked id="sms_reminder" name="sms_reminder"> Sms</label>
                            <label for="email_reminder"><input type="checkbox" checked id="email_reminder" name="email_reminder"> Email</label>
                        </p>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
</div>
<hr>
<div class="modal-footer">
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-3 col-md-9">
                <button type="button" class="btn green send-reminder">Submit</button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

    $('.send-reminder').click(function () {
        if($('#sms_reminder').is(':checked')){
            var smsReminder = 1;
        }else{
            var smsReminder = 0;
        }

        if($('#email_reminder').is(':checked')){
            var emailReminder = 1;
        }else{
            var emailReminder = 0;
        }

        $.easyAjax({
            container: '#reminderModal',
            url: '{{ route("gym-admin.client-purchase.sendRenewReminder") }}',
            type: "POST",
            data: {
                email: '{{$client_data->email}}',
                mobile: '{{$client_data->mobile}}',
                offer: '{{$client_data->offer}}',
                smsReminder: smsReminder,
                emailReminder: emailReminder,
                membership: '{{$client_data->membership}}',
                '_token': '{{ csrf_token() }}',
                purchaseId: '{{ $client_data->id }}'
            },
            success: function (response) {
                if (response.status == 'fail') {
                    $(".help-block").css('margin-left', '170px');
                }
                else {
                    $("#reminderModal").modal("hide");
                }

            }
        });
    });

</script>