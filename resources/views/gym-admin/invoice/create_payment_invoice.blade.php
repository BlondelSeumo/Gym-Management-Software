@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('admin/global/plugins/ladda/ladda-themeless.min.css') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
    {!! HTML::style('admin/global/plugins/typeahead/typeahead.css') !!}
    <style>
        .item-type-padding {
            padding-left: 12px;
        }
    </style>
@stop

@section('content')
    <div class="container-fluid"  >
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{ route('gym-admin.dashboard.index') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{ route('gym-admin.gym-invoice.index') }}">Invoices</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Create Invoice</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">

            <div class="row">
                <div class="col-xs-12">

                    <div class="portlet light portlet-fit">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-note font-red"></i><span class="caption-subject font-red bold uppercase">Create Invoice</span></div>


                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            {!! Form::open(['id'=>'storePayments','class'=>'ajax-form','method'=>'POST']) !!}
                            <div class="form-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Bill To</label>
                                            <input type="text" class="form-control" name="client_name" id="client_name" placeholder="Enter Client Name" value="{{ ucwords($payment->client->first_name.' '.$payment->client->last_name) }}">
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group" >
                                            <label class="control-label">Invoice Date</label>
                                            <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-icon">
                                                    <i class="fa fa-calendar"></i>
                                                    <input type="text" class="form-control date-picker" readonly name="invoice_date" id="invoice_date" value="{{ $payment->payment_date->format('m/d/Y') }}">
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Client Email</label>
                                            <input type="text" class="form-control" name="email" id="email" value="{{ $payment->client->email }}"
                                                   placeholder="Enter Client Email">
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="control-label">Mobile</label>

                                            <input type="text" class="form-control" name="mobile" id="mobile" value="{{ $payment->client->mobile }}"
                                                   placeholder="Enter Client Mobile">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Client Address</label>
                                            <textarea class="form-control" placeholder="Enter client address" name="client_address" id="client_address">{{ $payment->client->address }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                @if($gymSettings != '' && !is_null($gymSettings->gstin))
                                    <div class="row">
                                        <div class="col-md-12 margin-bottom-15">
                                            <label class="label label-danger">NOTE:</label> To include GST Taxes. Enter
                                            your GST number <a href="javascript:;" id="update-gst">here</a>.
                                        </div>
                                    </div>
                                @endif

                                <div class="row">

                                    <div class="col-xs-12  visible-md visible-lg">

                                        <div class="col-md-5 bg-dark bg-font-dark" style="padding: 8px 15px">
                                            ITEM
                                        </div>

                                        <div class="col-md-2 bg-dark bg-font-dark" style="padding: 8px 15px">
                                            QUANTITY
                                        </div>

                                        <div class="col-md-2 bg-dark bg-font-dark" style="padding: 8px 15px">
                                            RATE
                                        </div>

                                        <div class="col-md-2 bg-dark bg-font-dark text-center" style="padding: 8px 15px">
                                            AMOUNT
                                        </div>

                                        <div class="col-md-1 bg-dark bg-font-dark" style="padding: 8px 15px">
                                            &nbsp;
                                        </div>

                                    </div>

                                    <div class="col-xs-12 item-row margin-top-5">

                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="control-label hidden-md hidden-lg">Item Name</label>
                                                    <input type="text" class="form-control item_name" name="item_name[]"
                                                           placeholder="Item Name" value="{{ ucwords($item_name) }}">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-2">
                                            <div class="row">
                                                <div class="form-group item-type-padding">
                                                    <label class="control-label hidden-md hidden-lg">Item Type</label>
                                                    <select class="form-control item-type" name="item-type[]">
                                                        <option value="item" selected>Item</option>
                                                        <option value="discount">Discount</option>
                                                        <option value="tax">Tax</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">
                                                <label class="control-label hidden-md hidden-lg">Quantity</label>
                                                <input type="number" min="0" class="form-control quantity" value="1"
                                                       name="quantity[]" placeholder="Quantity">
                                            </div>


                                        </div>

                                        <div class="col-md-2">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="control-label hidden-md hidden-lg">Rate</label>
                                                    <input type="number" min="" class="form-control cost_per_item"
                                                           name="cost_per_item[]" value="{{ $item_price }}" placeholder="Cost per item">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-2 border-dark  text-center">
                                            <label class="control-label hidden-md hidden-lg">Amount</label>

                                            <p class="form-control-static"><i class="fa {{ $gymSettings->currency->symbol }}"></i><span
                                                        class="amount-html">{{ $item_price }}</span></p>
                                            <input type="hidden" class="amount" name="amount[]" value="{{ $item_price }}">
                                        </div>

                                        <div class="col-md-1 text-right visible-md visible-lg">
                                            <button class="btn remove-item btn-icon-only red"><i
                                                        class="fa fa-remove"></i></button>
                                        </div>
                                        <div class="col-md-1 hidden-md hidden-lg">
                                            <div class="row">
                                                <button class="btn btn-block remove-item red"><i
                                                            class="fa fa-remove"></i> Remove
                                                </button>
                                            </div>
                                        </div>

                                    </div>

                                    <div id="item-list">

                                    </div>

                                    <div class="col-xs-12 margin-top-5">
                                        <button class="btn blue" id="add-item"><i class="fa fa-plus"></i> Add Item</button>
                                    </div>

                                    <div class="col-xs-12 ">


                                        <div class="row">
                                            <div class="col-md-offset-9 col-xs-6 col-md-1 text-right padding-top-5" >Subtotal</div>

                                            <p class="form-control-static col-xs-6 col-md-2" >
                                                <i class="fa {{ $gymSettings->currency->symbol }}"></i><span class="sub-total">{{ $item_price }}</span>
                                            </p>


                                            <input type="hidden" class="sub-total-field" value="{{ $item_price }}" name="sub_total">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-offset-9 col-md-1 text-right padding-top-5">
                                                Discount
                                            </div>
                                            <div class="col-md-2">
                                                <div class="input-icon input-icon-md">
                                                    <i class="fa {{ $gymSettings->currency->symbol }} font-grey-mint"></i>
                                                    <input type="number" min="0" class="form-control discount-amount" name="discount_amount" value="{{ $discount }}">
                                                </div>
                                            </div>
                                        </div>
                                        @if($gymSettings != '' && !is_null($gymSettings->gstin))
                                            <div class="row margin-top-5 state-tax-hide">
                                                <div class="col-md-offset-9 col-md-1 text-right padding-top-5">
                                                    SGST
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-icon input-icon-md right">
                                                        <i class="fa fa-percent font-grey-mint"></i>
                                                        <input type="number" min="0" class="form-control sgst-percent" name="sgst" value="0">
                                                        <input type="hidden" name="sgst_amount" id="sgst_amount">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row margin-top-5 state-tax-hide">
                                                <div class="col-md-offset-9 col-md-1 text-right padding-top-5">
                                                    CGST
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-icon input-icon-md right">
                                                        <i class="fa fa-percent font-grey-mint"></i>
                                                        <input type="number" min="0" class="form-control cgst-percent" name="cgst" value="0">
                                                        <input type="hidden" name="cgst_amount" id="cgst_amount">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row margin-top-5 interstate-tax-hide">
                                                <div class="col-md-offset-9 col-md-1 text-right padding-top-5">
                                                    IGST
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-icon input-icon-md right">
                                                        <i class="fa fa-percent font-grey-mint"></i>
                                                        <input type="number" min="0" class="form-control igst-percent" name="igst" value="0">
                                                        <input type="hidden" name="igst_amount" id="igst_amount">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row margin-top-5 sbold">
                                            <div class="col-md-offset-9 col-md-1 col-xs-6 text-right padding-top-5" >Total</div>

                                            <p class="form-control-static col-xs-6 col-md-2" >
                                                <i class="fa {{ $gymSettings->currency->symbol }}"></i><span class="total">{{ $item_price-$discount }}</span>
                                            </p>


                                            <input type="hidden" class="total-field" value="{{ $item_price-$discount }}" name="total">
                                        </div>

                                        <div class="row margin-top-5">
                                            <div class="form-group col-md-2 col-md-offset-10">
                                                    <label class="control-label">Invoice Generated By</label>

                                                    <input type="text" readonly class="form-control" name="generated_by" id="generated_by" value="{{ ucwords($user->first_name.' '.$user->last_name) }}" >
                                                <span class="help-block"><em>*This cannot be changed</em></span>

                                            </div>
                                        </div>




                                    </div>

                                </div>




                            </div>
                            <div class="form-actions" style="margin-top: 70px">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn dark mt-ladda-btn ladda-button" data-style="zoom-in" id="save-form">
                                            <span class="ladda-label"><i class="fa fa-save"></i> SAVE</span>
                                        </button>
                                        <button type="reset" class="btn default">Reset</button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                                    <!-- END FORM-->
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
    {{--Start GSTIN Update Modal--}}
    <div class="modal fade" id="updateGST" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Update GST Number</h4>
                </div>
                <div class="modal-body">
                    <form id="updateGstNumber">
                        <div class="form-group form-md-line-input has-success">
                            <label class="col-md-2 control-label" for="form_control_1">GSTIN</label>
                            <div class="col-md-6">
                                <div class="input-icon right">
                                    <input type="text" class="form-control" placeholder="GSTIN" id="gstin" name="gstin" value="@if($gymSettings !=''){{$gymSettings->gstin}}@endif">
                                    <div class="form-control-focus"> </div>
                                    <span class="help-block">Enter GSTIN</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" id="updateBtn" class="btn green">Update</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--End GSTIN Update Modal--}}
@stop

@section('footer')

    {!! HTML::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
    {!! HTML::style('admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
    {!! HTML::script('admin/global/plugins/ladda/spin.min.js') !!}
    {!! HTML::script('admin/global/plugins/ladda/ladda.min.js') !!}
    {!! HTML::script('admin/pages/scripts/ui-buttons.min.js') !!}
    {!! HTML::script('admin/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('admin/pages/scripts/components-bootstrap-select.min.js') !!}
    {!! HTML::script('admin/global/plugins/typeahead/handlebars.min.js') !!}
    {!! HTML::script('admin/global/plugins/typeahead/typeahead.bundle.min.js') !!}


    <script>
        var ComponentsTypeahead = function () {

            var handleTwitterTypeahead = function() {

                // Example #1
                // instantiate the bloodhound suggestion engine
                var numbers = new Bloodhound({
                    datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.num); },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: [
                        @foreach($memberships as $mem)
                        { num: '{{ ucfirst($mem->title." - ".$mem->subCategory->Category->name) }}' },
                        @endforeach
                    ]
                });

                // initialize the bloodhound suggestion engine
                numbers.initialize();

                // instantiate the typeahead UI
                if (App.isRTL()) {
                    $('.item_name').attr("dir", "rtl");
                }
                $('.item_name').typeahead(null, {
                    displayKey: 'num',
                    hint: (App.isRTL() ? false : true),
                    source: numbers.ttAdapter()
                });


            }

            return {
                //main function to initiate the module
                init: function () {
                    handleTwitterTypeahead();
                }
            };

        }();

        jQuery(document).ready(function() {
            ComponentsTypeahead.init();
        });
    </script>


    <script>

        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true
        });

        $('#save-form').click(function(){
            $.easyAjax({
                url:'{{route('gym-admin.gym-invoice.save-invoice')}}',
                container:'#storePayments',
                type: "POST",
                redirect: true,
                data:$('#storePayments').serialize()
            })
        });

        $('#add-item').click(function () {
            var item = '<div class="col-xs-12 item-row margin-top-5">'

                + '<div class="col-md-3">'
                + '<div class="row">'
                + '<div class="form-group">'
                + '<label class="control-label hidden-md hidden-lg">Item Name</label>'
                + '<input type="text" class="form-control item_name" name="item_name[]" placeholder="Item Name">'
                + '</div>'
                + '</div>'

                + '</div>'
                + '<div class="col-md-2">'
                + '<div class="row">'
                + '<div class="form-group item-type-padding">'
                + '<label class="control-label hidden-md hidden-lg">Item Type</label>'
                + '<select class="form-control item-type" name="item-type[]">'
                + '<option value="item" selected>Item</option>'
                + '<option value="discount">Discount</option>'
                + '<option value="tax">Tax</option>'
                + '</select>'
                + '</div>'
                + '</div>'
                +   '</div>'

                + '<div class="col-md-2">'

                + '<div class="form-group">'
                + '<label class="control-label hidden-md hidden-lg">Quantity</label>'
                + '<input type="number" min="0" class="form-control quantity" value="0" name="quantity[]" placeholder="Quantity">'
                + '</div>'


                + '</div>'

                + '<div class="col-md-2">'
                + '<div class="row">'
                + '<div class="form-group">'
                + '<label class="control-label hidden-md hidden-lg">Rate</label>'
                + '<input type="number" min="0" class="form-control cost_per_item" value="0" name="cost_per_item[]" placeholder="Cost per item">'
                + '</div>'
                + '</div>'

                + '</div>'

                + '<div class="col-md-2 text-center">'
                + '<label class="control-label hidden-md hidden-lg">Amount</label>'
                + '<p class="form-control-static"><i class="fa {{ $gymSettings->currency->symbol }}"></i><span class="amount-html">0</span></p>'
                + '<input type="hidden" class="amount" name="amount[]">'
                + '</div>'

                + '<div class="col-md-1 text-right visible-md visible-lg">'
                + '<button class="btn remove-item btn-icon-only red"><i class="fa fa-remove"></i></button>'
                + '</div>'

                + '<div class="col-md-1 hidden-md hidden-lg">'
                + '<div class="row">'
                + '<button class="btn btn-block remove-item red"><i class="fa fa-remove"></i> Remove</button>'
                + '</div>'
                + '</div>'

                + '</div>';

            $('.item_name').typeahead('destroy'); //need to destroy & reinitialize for dynamic element
            $(item).hide().appendTo("#item-list").fadeIn(500);
            ComponentsTypeahead.init();

        });

        $('#storePayments').on('click', '.remove-item', function () {
            $(this).closest('.item-row').fadeOut(300, function () {
                $(this).remove();
                calculateTotal();
            });
        });

        $('#storePayments').on('keyup', '.quantity,.cost_per_item', function () {
            var quantity = $(this).closest('.item-row').find('.quantity').val();

            var perItemCost = $(this).closest('.item-row').find('.cost_per_item').val();

            var amount = (quantity * perItemCost);

            $(this).closest('.item-row').find('.amount').val(amount);
            $(this).closest('.item-row').find('.amount-html').html(amount);

            calculateTotal();


        });

        function calculateTotal() {

            var subtotal = 0;
            var tax = 0;
            var discountAmount = 0;

            //region Check Item Type
            $(".quantity").each(function (index, element) {

                var itemType = $(this).closest('.item-row').find('.item-type').val();
                var amount = $(this).closest('.item-row').find('.amount').val();

                if(itemType == 'item') {
                    subtotal = parseFloat(subtotal) + parseFloat(amount);
                }

                if(itemType == 'tax') {
                    tax = parseFloat(tax) + parseFloat(amount);
                }

                if(itemType == 'discount') {
                    discountAmount = parseFloat(discountAmount) + parseFloat(amount);
                }

            });
            //endregion

            //region Sub Total
            $('.sub-total').html(subtotal);
            $('.sub-total-field').val(subtotal);
            //endregion

            //region Discount
            $('.discount').html(discountAmount);
            $('.discount-field').val(discountAmount);
            //endregion

            //region Tax
            $('.tax').html(tax);
            $('.tax-field').val(tax);
            //endregion

            var totalAfterDiscount = (subtotal - discountAmount);
            var total = totalAfterDiscount + tax;

            //region Total Amount
            $('.total').html(total);
            $('.total-field').val(total);
            //endregion
        }

        $('.reset-btn').click(function () {
            $('.amount-html').text('');
            $('.sub-total').text('');
            $('.total').text('');
        });

    </script>
@stop