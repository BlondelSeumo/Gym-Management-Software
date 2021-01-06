<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <span class="caption-subject font-red-sunglo bold uppercase">{{ ucwords($tutorial->title) }}</span>
</div>
<div class="modal-body">

    <div class="portlet-body">

        <div class="row">
            <div class="col-md-12">

                {!! $tutorial->iframe_code !!}

            </div>
        </div>

    </div>
</div>
</div>
<hr>
<div class="modal-footer">
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-3 col-md-9">
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>