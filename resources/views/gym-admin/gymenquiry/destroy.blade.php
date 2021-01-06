<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <span class="caption-subject font-red-sunglo bold uppercase">Remove enquiry</span>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <p> Are you Sure you want to Remove {{ ucwords($enquiry->customer_name) }} ?</p>
        </div>
    </div>
</div>
</div>
<div class="modal-footer">
    <a href="javascript:;" data-enquiry-id="{{ $enquiry->id }}" class="btn blue" id="removeEnquiry" >Remove</a>
</div>