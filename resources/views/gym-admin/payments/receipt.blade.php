<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <span class="caption-subject font-red-sunglo bold uppercase"><i class="font-red fa fa-file-pdf-o"></i> Receipt #{{ $payment->payment_id }}</span>
</div>
<div class="modal-body tabbable-line">
    <div class="portlet-body">
        {!! Form::open(['id'=>'gym-offer_data','class'=>'ajax-form','method'=>'POST']) !!}
        <div class="tab-content">
            <div class="tab-pane active" id="portlet_tab1">
                <div class="row">

                        <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center"
                               style="max-width:600px;margin:auto;border-spacing:0;border-collapse:collapse;background:white">


                            <tbody>
                            <tr>

                                <td style="text-align:center;vertical-align:top;font-size:0;border-collapse:collapse;padding-left:15px;padding-right:15px">


                                    <table border="0" width="100%" cellpadding="0" cellspacing="0"
                                           style="border-spacing:0;border-collapse:collapse">

                                        <tbody>
                                        <tr>

                                            <td height="15" style="font-size:0;line-height:0;border-collapse:collapse">&nbsp;</td>

                                        </tr>

                                        </tbody>
                                    </table>


                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="#f6f6f6"
                                           style="border-spacing:0;border-collapse:collapse">


                                        <tbody>
                                        <tr>

                                            <td valign="middle" align="center"
                                                style="padding:30px 0;text-align:center;background-color:white;border-collapse:collapse">

                                                {!! HTML::image('admin/admin/layout4/img/hp-logo-black-big-2.png', 'Logo',array("style" => "margin:auto;text-align:center;border:0;outline:none;text-decoration:none", "align" => "center",'border' => '0','width' => '240')) !!}

                                            </td>

                                        </tr>


                                        <tr>

                                            <td valign="middle" align="center"
                                                style="padding-top:20px;text-align:center;background-color:white;border-top:1px solid #e6e6e6">

                                                <span style="font-size:24px;color:#2d2d2d">Thanks for being our member!</span>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td valign="middle" align="center"
                                                style="padding:10px 15px 20px 15px;text-align:center;background-color:white;border-collapse:collapse">

                                                <div style="font-size:15px;color:#6d6d6d;font-weight:normal">Here's your payment receipt. If you
                                                    have any feedback, do share with us.
                                                </div>



                                            </td>


                                        </tr>


                                        <tr>

                                            <td style="border-collapse:collapse">


                                                <table border="0" width="92%" cellpadding="0" cellspacing="0" bgcolor="#f6f6f6"
                                                       style="margin-top:20px;margin-left:4%;margin-right:4%;border-spacing:0;border-collapse:collapse">


                                                    <tbody>
                                                    <tr>

                                                        <td style="padding-top:5px;border-collapse:collapse;font-family:sans-serif;font-size:15px;line-height:24px;text-transform:uppercase;color:#2d2d2a;text-align:left">

                                                            Payment Summary

                                                        </td>

                                                    </tr>

                                                    <tr>

                                                        <td style="border-collapse:collapse;font-family:sans-serif;font-size:12px;line-height:17px;color:#7d7d76;text-align:left">

                                                            Payment ID: {{ $payment->payment_id }}

                                                        </td>

                                                    </tr>

                                                    <tr>

                                                        <td style="font-family:sans-serif;font-size:12px;line-height:20px;border-collapse:collapse;color:#7d7d76;border-bottom:1pt solid #cbcbc8;padding-bottom:20px;text-align:left">

                                                            Date: {{ $payment->payment_date->format('d M, Y') }}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <td style="border-collapse:collapse">


                                                            <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center"
                                                                   style="margin-top:10px;border-spacing:0;border-collapse:collapse">


                                                                <tbody>
                                                                <tr style="border-bottom:1pt solid #cbcbc8">

                                                                    <td valign="middle" width="70%"
                                                                        style="border-collapse:collapse;font-family:sans-serif;font-size:14px;line-height:30px;color:#2d2d2a;text-align:left;padding-bottom: 10px">

                                                                        @if(!is_null($payment->purchase->membership_id))
                                                                            {{ ucwords($payment->purchase->membership->title) }}
                                                                        @elseif(!is_null($payment->purchase->offer_id))
                                                                            {{ ucwords($payment->purchase->offer->title) }}
                                                                        @elseif(!is_null($payment->purchase->package_id))
                                                                            {{ ucwords($payment->purchase->package->title) }}
                                                                        @endif

                                                                    </td>

                                                                    <td valign="middle" width="30%"
                                                                        style="border-collapse:collapse;font-family:sans-serif;font-size:14px;line-height:30px;color:#2d2d2a;text-align:right">

                                                                        Rs. {{ $payment->payment_amount }}

                                                                    </td>

                                                                </tr>


                                                                </tbody>
                                                            </table>



                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <td style="border-collapse:collapse;font-family:sans-serif;font-size:12px;line-height:17px;color:#7d7d76;padding-top:15px;text-align:left">

                                                            Paid by

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <td style="border-collapse:collapse">


                                                            <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center"
                                                                   style="border-spacing:0;border-collapse:collapse">

                                                                <tbody>
                                                                <tr>

                                                                    <td valign="middle" width="70%"
                                                                        style="border-collapse:collapse;font-family:sans-serif;font-size:14px;line-height:21px;color:#2d2d2a;padding-bottom:15px;text-align:left">

                                                                        {{ ucfirst(str_replace('_',' ',$payment->payment_source)) }}

                                                                    </td>

                                                                    <td valign="middle" width="30%"
                                                                        style="border-collapse:collapse;font-family:sans-serif;font-size:14px;line-height:21px;color:#2d2d2a;padding-bottom:15px;text-align:right">

                                                                        Rs. {{ $payment->payment_amount }}

                                                                    </td>

                                                                </tr>

                                                                </tbody>
                                                            </table>


                                                        </td>

                                                    </tr>


                                                    </tbody>
                                                </table>


                                            </td>

                                        </tr>


                                        </tbody>
                                    </table>


                                </td>

                            </tr>

                            <tr>

                                <td style="border-collapse:collapse;padding-left:15px;padding-right:15px">


                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="#ffffff"
                                           style="border-spacing:0;border-collapse:collapse">

                                        <tbody>
                                        <tr>

                                            <td valign="middle" style="border-collapse:collapse;padding-top:20px">


                                                <table border="0" width="84%" cellpadding="0" cellspacing="0"
                                                       style="margin-left:8%;margin-right:8%;border-spacing:0;border-collapse:collapse">


                                                    <tbody>
                                                    <tr>

                                                        <td style="border-collapse:collapse">


                                                            <table border="0" width="100%" cellpadding="0" cellspacing="0"
                                                                   style="border-spacing:0;border-collapse:collapse">


                                                                <tbody>
                                                                <tr>

                                                                    <td style="border-collapse:collapse;font-family:sans-serif;font-size:12px;line-height:17px;color:#7d7d76;text-align:center">

                                                                        Issued on behalf of

                                                                    </td>

                                                                </tr>

                                                                <tr>

                                                                    <td style="border-collapse:collapse;font-family:sans-serif;font-size:14px;line-height:21px;color:#2d2d2a;text-align:center">

                                                                       {{ ucwords($merchantBusiness->business->title) }}

                                                                    </td>

                                                                </tr>

                                                                <tr>

                                                                    <td style="border-collapse:collapse;font-family:sans-serif;font-size:12px;line-height:17px;color:#7d7d76;padding-bottom:15px;text-align:center">

                                                                        {{ ucwords($merchantBusiness->business->address.', '.$merchantBusiness->business->area->name.', '.$merchantBusiness->business->city->name) }}

                                                                    </td>

                                                                </tr>

                                                                </tbody>
                                                            </table>

                                                        </td>

                                                    </tr>

                                                    </tbody>
                                                </table>

                                            </td>

                                        </tr>


                                        </tbody>
                                    </table>


                                </td>

                            </tr>


                            </tbody>
                        </table>

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
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
