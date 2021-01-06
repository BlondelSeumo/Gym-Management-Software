<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <span class="caption-subject font-red-sunglo bold uppercase">Remove Expense</span>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <p> Do you want to remove expense {{$expense->item_name}} ?</p>
        </div>
    </div>
</div>
</div>
<div class="modal-footer">
    <a href="javascript:;" class="btn blue" id="removeClient" >Remove</a>
</div>

<script>
    $('#removeClient').click(function(){
        $.easyAjax({
            url: '{{route('gym-admin.expense.destroy', $expense->id)}}',
            container:'.modal-body',
            type: "DELETE"
        })
    });
</script>