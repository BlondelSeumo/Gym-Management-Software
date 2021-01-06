<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <span class="caption-subject font-red-sunglo bold uppercase">Add New Offer</span>
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
            {!! Form::open(['id'=>'gym-offer_data','class'=>'ajax-form','method'=>'POST']) !!}
            <div class="tab-content">
                <div class="tab-pane active" id="portlet_tab1">
                    <div class="row">
                        <div class="col-md-12">

                                <div class="form-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label">Offer Title</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="Offer Title" name="title" id="title">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label">Membership</label>
                                        <div class="col-md-6">
                                            <select  class="bs-select form-control" data-live-search="true" data-size="8" name="membership_id" id="membership_id">
                                                <option value="">Select Membership</option>
                                                @foreach($memberships as $key => $membership)
                                                    <optgroup label="{{$key}}">
                                                        @foreach($membership as $mem)
                                                            <option value="{{$mem->id}}" data-price="{{$mem->price}}">{{$mem->title}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label">Offer Description</label>
                                        <div class="col-md-6">
                                            <textarea  rows="3" class="form-control" placeholder="Offer Description" id="description" name="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label">Valid From</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input  class="form-control date-picker" readonly name="valid_from" id="valid_from">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label ">Valid To</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input  class="form-control date-picker" readonly onmousewheel="" name="valid_too" id="valid_too" >
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
                                                <input type="number" min="0" class="form-control" name="original_price" id="original_price">
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
                                                <input type="number" min="0" class="form-control" name="discounted_price" id="discount_price">
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
                                                        <input type="radio" id="offer_for_male" name="offer_for" value="male" class="md-radiobtn">
                                                        <label for="offer_for_male">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Male </label>
                                                    </div>
                                                    <div class="md-radio has-info">
                                                        <input type="radio" id="offer_for_female" name="offer_for" value="female" class="md-radiobtn" checked>
                                                        <label for="offer_for_female">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Female</label>
                                                    </div>
                                                    <div class="md-radio has-info">
                                                        <input type="radio" id="offer_for_both" name="offer_for" value="both" class="md-radiobtn">
                                                        <label for="offer_for_both">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Both </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr>


                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="portlet_tab2">
                    <p> Add Image for Gym Offer</p>
                    <div class="form-group">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="{{$gymOffersPath.'gym-offer-default.jpg'}}" alt="" /> </div>
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
                <button  type="button" id="offer_data" class="btn green">Submit</button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
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
            url: '{{route('gym-admin.offers.store')}}',
            container:'#gym-offer_data',
            type: "POST",
            file:true,
            formReset:true

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
