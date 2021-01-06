<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <span class="caption-subject font-red-sunglo bold uppercase">Edit Offer</span>
</div>
<div class="modal-body tabbable-line">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#portlet_tab1" data-toggle="tab"> Data </a>
        </li>
        <li>
            <a href="#portlet_tab2" data-toggle="tab"> Image </a>
        </li>
    </ul>
    <hr>
    <div class="portlet-body">
        <div class="tab-content">

            <div class="tab-pane active" id="portlet_tab1">
                {!! Form::open(['id'=>'gym-offer_data','class'=>'ajax-form']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="_method" value="put">
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Offer Title</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Offer Title" name="title" id="title" value="{{$offer->title}}">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 control-label">Membership</label>
                                <div class="col-md-6">
                                    <select  class="bs-select form-control" data-live-search="true" data-size="8" name="membership_id" id="membership_id">
                                        <option>Select Membership</option>
                                        @foreach($memberships as $key => $membership)
                                            <optgroup label="{{$key}}">
                                                @foreach($membership as $mem)
                                                    <option value="{{$mem->id}}" data-price="{{$mem->price}}" @if($mem->id == $offer->membership_id) selected @endif>{{$mem->title}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 control-label">Offer Description</label>
                                <div class="col-md-6">
                                    <textarea  rows="3" class="form-control" placeholder="Offer Description" id="description" name="description">{{$offer->details}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Valid From</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input  class="form-control date-picker" readonly  name="valid_from" id="valid_from" value="{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$offer->valid_from)->format('m/d/Y')}}">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label ">Valid Too</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input  class="form-control date-picker" readonly name="valid_too" id="valid_too" value="{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$offer->valid_to)->format('m/d/Y')}}" >
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Original Price</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" name="original_price" id="original_price" value="{{$offer->original_price}}">
                                            <span class="input-group-addon">
                                                <i class="fa fa-inr"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Discounted Price</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="number" min="0"  class="form-control" name="discounted_price" id="discount_price" value="{{$offer->discounted_price}}">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-inr"></i>
                                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Offer For</label>
                                <div class="col-md-6">
                                    <div class="form-group form-md-radios">
                                        <div class="md-radio-inline">
                                            <div class="md-radio has-info">
                                                <input type="radio" id="offer_for_male" name="offer_for" value="male" class="md-radiobtn" @if($offer->offer_for == 'male')checked @endif>
                                                <label for="offer_for_male">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Male </label>
                                            </div>
                                            <div class="md-radio has-info">
                                                <input type="radio" id="offer_for_female" name="offer_for" value="female" class="md-radiobtn" @if($offer->offer_for == 'female')checked @endif>
                                                <label for="offer_for_female">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Female</label>
                                            </div>
                                            <div class="md-radio has-info">
                                                <input type="radio" id="offer_for_both" name="offer_for" value="both" class="md-radiobtn" @if($offer->offer_for == 'both')checked @endif>
                                                <label for="offer_for_both">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Both </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Status</label>
                                <div class="col-md-7">
                                    <div class="form-group form-md-radios">
                                        <div class="md-radio-inline has-info">

                                            <div class="md-radio has-info">
                                                <input type="radio" id="status_active" name="status" value="active" class="md-radiobtn" @if($offer->status == 'active')checked @endif>
                                                <label for="status_active">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Active</label>
                                            </div>
                                            <div class="md-radio has-info">
                                                <input type="radio" id="status_inactive" name="status" value="inactive" class="md-radiobtn" @if($offer->status == 'inactive')checked @endif>
                                                <label for="status_inactive">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> In-Active </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <input type="hidden" name="type" value="data">
                                    <input type="hidden" name="id" value="{{$offer->id}}">
                                    <button  type="button" id="offer_data" class="btn green">Submit</button>
                                    <button type="button" class="btn default">Cancel</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="tab-pane" id="portlet_tab2">
                {!! Form::open(['id'=>'gym-offer-image','class'=>'ajax-form']) !!}
                <p> Add Image for Gym Offer</p>
                <input type="hidden" name="_method" value="put">
                <div class="form-group">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                            <img src="{{$gymOffersPath.$offer->image}}" alt="" /> </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                        <div>
                                <span class="btn default btn-file">
                                    <span class="fileinput-new"> Select image </span>
                                    <span class="fileinput-exists"> Change </span>
                                    <input type="file" name="file"> </span>
                            <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="margin-top-10">
                    <input type="hidden" name="type" value="image">
                    <input type="hidden" name="id" value="{{$offer->id}}">
                    <a href="javascript:;" class="btn green" id="offer_image"> Submit </a>
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script>
    $('#valid_from').datepicker({
        autoclose: true,
    }).on('changeDate', function(){
        $('#valid_too').datepicker('setStartDate', new Date($(this).val()));
    });

    $('#valid_too').datepicker({
        autoclose: true,
    }).on('changeDate', function(){
        $('#valid_from').datepicker('setEndDate', new Date($(this).val()));
    });
    $('#offer_data').click(function(){
        $.easyAjax({
            url: '{{route('gym-admin.offers.update',$offer->id)}}',
            container:'#gym-offer_data',
            type: "PUT",
            data:$('#gym-offer_data').serialize()
        });
    });
    $('#offer_image').click(function(){
        $.easyAjax({
            url: '{{route('gym-admin.offers.update',$offer->id)}}',
            container:'#gym-offer-image',
            type: "POST",
            file:true
        });
    });
    $('.bs-select').selectpicker({
        iconBase: 'fa',
        tickIcon: 'fa-check'
    });

    $('#membership_id').on('change',function () {
        var price = $('#membership_id :selected').data('price');
        $('#original_price').val(price);
    });
</script>
