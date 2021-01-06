<div class="form-group">
    <label class="col-sm-3 control-label">Customer Name</label>

    <div class="col-sm-6">
        <p class="form-control-static">
            {{ ucwords($booking->user->first_name.' '.$booking->user->last_name) }}
        </p>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-3 control-label">Joining On</label>

    <div class="col-sm-6">
        <p class="form-control-static">{{ $booking->date->format('d-M').' - '.\Carbon\Carbon::createFromFormat('H:i:s',$booking->classes->start_time)->format('h:i A') }}</p>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Amount</label>

    <div class="col-sm-6">
        <p class="form-control-static"><i class="fa fa-rupee"></i> {{ $booking->original_amount }}</p>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Purchase</label>

    <div class="col-sm-6">
        @if(!is_null($booking->offer_id))
            <div class="form-control-static"> {{ $booking->offer->title }} </div>
        @elseif(!is_null($booking->package_id))
            <div class="form-control-static"> {{ $booking->package->title }} </div>
        @elseif(!is_null($booking->membership_id))
            <div class="form-control-static"> {{ $booking->membership->title }} </div>
        @endif
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Status</label>

    <div class="col-sm-6">
        <p class="form-control-static">
            @if($booking->status == 'confirmed')
                <span class="label uppercase label-primary"> confirmed </span>
            @elseif($booking->status == 'redeemed')
                <span class="label uppercase label-success"> redeemed </span>
                <br>Redeemed On: {{ $booking->redeemed_on->format('d-M h:i A') }}
            @elseif($booking->status == 'cancelled'){
            <span class="label uppercase label-danger"> cancelled </span>
            @endif
        </p>
    </div>
</div>

@if($booking->status == "redeemed")
    <div class="form-group">
        <label class="col-sm-3 control-label">Redeemed On</label>

        <div class="col-sm-6">
            <p class="form-control-static">{{ $booking->redeemed_on->format('d F h:i A') }}</p>
        </div>
    </div>
@endif

@if($booking->status != "redeemed")
    <div class="form-group">
        <div class="col-sm-6 col-sm-offset-3">
            <button type="button" class="btn btn-success redeem-appointment"><i class="fa fa-forward"></i> Redeem
            </button>
        </div>
    </div>
@endif


