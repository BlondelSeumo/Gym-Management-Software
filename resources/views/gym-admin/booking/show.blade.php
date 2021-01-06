<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <span class="caption-subject font-green bold uppercase"><i class="fa fa-calendar"></i> Booking Detail</span>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12 form">
            <!-- BEGIN FORM-->
            {!! Form::open(['id'=>'form_sample_3','class'=>'ajax-form form-horizontal form-row-seperated','method'=>'POST']) !!}
            <div class="form-body">

                <div class="form-group form-md-line-input">
                    <label class="col-md-4 control-label" for="form_control_1">Name</label>
                    <div class="col-md-8">
                        <div class="form-control form-control-static"> {{ $booking->user->first_name.' '.$booking->user->last_name }} </div>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                @if($booking->status == 'redeemed')
                    <div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label" for="form_control_1">Booking ID</label>
                        <div class="col-md-8">
                            <div class="form-control form-control-static"> {{ $booking->booking_id }} </div>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                @endif

                <div class="form-group form-md-line-input">
                    <label class="col-md-4 control-label" for="form_control_1">Purchase Type</label>
                    <div class="col-md-8">
                        <div class="form-control form-control-static"> <span class="label uppercase label-info"> {{ $booking->purchase_type }}  </span></div>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-md-4 control-label" for="form_control_1">Purchase</label>
                    <div class="col-md-8">
                        @if(!is_null($booking->offer_id))
                            <div class="form-control form-control-static"> {{ $booking->offer->title }} </div>
                        @elseif(!is_null($booking->package_id))
                            <div class="form-control form-control-static"> {{ $booking->package->title }} </div>
                        @elseif(!is_null($booking->membership_id))
                            <div class="form-control form-control-static"> {{ $booking->membership->title }} </div>
                        @endif
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-md-4 control-label" for="form_control_1">Joining Date & Time</label>
                    <div class="col-md-8">
                        <div class="form-control form-control-static"> {{ $booking->date->format('d-M').' - '.\Carbon\Carbon::createFromFormat('H:i:s',$booking->classes->start_time)->format('h:i A') }}</div>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-md-4 control-label" for="form_control_1">Order Total</label>
                    <div class="col-md-8">
                        <div class="form-control form-control-static"><i class="fa fa-rupee"></i> {{ $booking->original_amount }}</div>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-md-4 control-label" for="form_control_1">Status</label>
                    <div class="col-md-8">
                        @if($booking->status == 'confirmed')
                            <span class="label uppercase label-primary"> confirmed </span>
                        @elseif($booking->status == 'redeemed')
                            <span class="label uppercase label-success"> redeemed </span>
                            <br>Redeemed On: {{ $booking->redeemed_on->format('d-M h:i A') }}
                        @elseif($booking->status == 'cancelled'){
                            <span class="label uppercase label-danger"> cancelled </span>
                        @endif

                        <div class="form-control-focus"> </div>
                    </div>
                </div>


            </div>
            {!! Form::close() !!}
                    <!-- END FORM-->

        </div>
    </div>
</div>
</div>
<div class="modal-footer">
    <a href="javascript:;" class=" btn red" data-dismiss="modal" >Close</a>
</div>