<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title" id="myLargeModalLabel">Subscription Details</h4>
</div>
<div class="modal-body">
    <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Membership</th>
                            <th>Amount To Be Paid</th>
                            <th>Remaining Amount</th>
                            <th>Purchase Date</th>
                            <th>Expires On</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $showSubscription->membership->title }}</td>
                            <td>{{ $showSubscription->amount_to_be_paid }}</td>
                            <td>{{ $showSubscription->amount_to_be_paid - $showSubscription->paid_amount }}</td>
                            <td>{{ $showSubscription->purchase_date->toFormattedDateString() }}</td>
                            <td>{{ (isset($showSubscription->expires_on))? $showSubscription->expires_on->toFormattedDateString(): '-' }}</td>
                            <td>{{ ($showSubscription->status == 'active')? ucwords($showSubscription->status): ucwords($showSubscription->status) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
</div>
<div class="modal-footer">
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-3 col-md-9">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>