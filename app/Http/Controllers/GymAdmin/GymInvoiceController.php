<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Models\GymInvoice;
use App\Models\GymMembership;
use App\Models\GymMembershipPayment;
use App\Models\GymSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Models\GymInvoiceItems;
use Barryvdh\DomPDF\Facade as PDF;

class GymInvoiceController extends GymAdminBaseController
{
    public function __construct() {
        parent::__construct();
        $this->data['paymentMenu'] = 'active';
        $this->data['invoiceMenu'] = 'active';
    }

    public function index() {
        if (!$this->data['user']->can("view_invoice")) {
            return App::abort(401);
        }

        $this->data['title'] = 'Invoices';
        return view('gym-admin.invoice.index', $this->data);
    }

    public function create() {
        if (!$this->data['user']->can("view_invoice")) {
            return App::abort(401);
        }

        $invoices = GymInvoice::with('items')
            ->where('detail_id','=', $this->data['user']->detail_id);

        return Datatables::of($invoices)->add_column('items_column', function ($row) {
            //return $row->items[0]->item_name;

            $str = '<ol>';
            foreach ($row->items as $item):
                if($item->item_type == 'item'):
                    $str .= '<li>' . $item->item_name . '</li>';
                endif;
            endforeach;
            $str .= '</ol>';
            return $str;

        })->add_column('action', function ($row) {
            return '<div class="btn-group">
                        <button class="btn green btn-xs dropdown-toggle" type="button" data-toggle="dropdown"> <span class="hidden-xs">Actions</span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="' . route('gym-admin.gym-invoice.generate-invoice', $row->id) . '"><i class="fa fa-search"></i> View </a>
                        </li>
                        <li>
                            <a href="' . route('gym-admin.gym-invoice.download-invoice', $row->id) . '"><i class="fa fa-download"></i> Download </a>
                        </li>
                        <li>
                            <a href="javascript:;" data-invoice-id="' . $row->id . '" class="remove-invoice"> <i class="fa fa-trash"></i> Delete</a>
                        </li>
                    </ul>
                </div>';
        })->edit_column('invoice_date', function ($row) {
            return $row->invoice_date->format('d M Y');
        })->edit_column('total', function ($row) {
            return '<i class="fa '.$this->data['gymSettings']->currency->symbol.'"></i>' . round($row->total, 2);
        })->remove_column('id')
            ->remove_column('merchant_id')
            ->remove_column('client_address')
            ->remove_column('detail_id')
            ->remove_column('sub_total')
            ->remove_column('created_at')
            ->remove_column('updated_at')
            ->remove_column('items')
            ->remove_column('mobile')
            ->remove_column('email')
            ->rawColumns([0,1])
            ->make(true);
    }

    public function createInvoice() {
        if (!$this->data['user']->can("create_invoice")) {
            return App::abort(401);
        }

        $this->data['memberships'] = GymMembership::membershipByBusiness($this->data['user']->detail_id);

        return view('gym-admin.invoice.create_invoice', $this->data);
    }

    public function saveInvoice(Request $request) {
        if (!$this->data['user']->can("create_invoice")) {
            return App::abort(401);
        }

        $items = $request->input('item_name');
        $item_type = $request->input('item-type');
        $amount = $request->input('amount');
        $client_address = $request->input('client_address');
        $client_name = $request->input('client_name');
        $clientEmail = $request->input('email');
        $clientMobile = $request->input('mobile');
        $cost_per_item = $request->input('cost_per_item');
        $discount_amount = ( $request->input('discount_amount') == null )? 0: $request->input('discount_amount');
        $invoice_date = $request->input('invoice_date');
        $quantity = $request->input('quantity');
        $sub_total = $request->input('sub_total');
        $total = $request->input('total');
        $generatedBy = $request->input('generated_by');

        $validator = Validator::make(Input::all(), GymInvoice::rules('add'));

        if ($validator->fails()) {
            return Reply::formErrors($validator);
        }

        if (trim($items[0]) == '' || trim($items[0]) == '' || trim($cost_per_item[0]) == '') {
            return Reply::error('Add at-least 1 item.');
        }

        foreach ($items as $item) {
            if($item == '') {
                return Reply::error('Item Name is empty');
            }
        }

        foreach ($quantity as $qty) {
            if (!is_numeric($qty)) {
                return Reply::error('Quantity should be a number.');
            }
        }

        foreach ($cost_per_item as $rate) {
            if (!is_numeric($rate)) {
                return Reply::error('Rate should be a number.');
            }
        }


        $invoice = new GymInvoice();
        $invoice->merchant_id = $this->data['user']->id;
        $invoice->detail_id = $this->data['user']->detail_id;
        $invoice->client_address = $client_address;
        $invoice->client_name = $client_name;

        if($clientEmail != ''){
            $invoice->email = $clientEmail;
        }

        if($clientMobile != ''){
            $invoice->mobile = $clientMobile;
        }

        $invoice->discount_amount = $discount_amount;
        $invoice->invoice_date = Carbon::createFromFormat('m/d/Y', $invoice_date)->format('Y-m-d');
        $invoice->sub_total = $sub_total;
        $invoice->total = $total;
        $invoice->generated_by = $generatedBy;
        $invoice->save();

        $invoice->invoice_number = strtoupper(str_random(5)) . $invoice->id;
        $invoice->save();

        foreach ($items as $key => $item):
            GymInvoiceItems::create(['invoice_id' => $invoice->id, 'item_name' => $item, 'item_type' => $item_type[$key], 'quantity' => $quantity[$key], 'cost_per_item' => $cost_per_item[$key], 'amount' => $amount[$key]]);
        endforeach;

        return Reply::redirect(route('gym-admin.gym-invoice.generate-invoice', $invoice->id));

    }

    public function generateInvoice($id) {
        if (!$this->data['user']->can("create_invoice")) {
            return App::abort(401);
        }

        $this->data['title'] = 'Invoices';

        $this->data['invoice'] = GymInvoice::byInvoiceId($id, $this->data['user']->detail_id);
        $this->data['settings'] = GymSetting::GetMerchantInfo($this->data['user']->detail_id);

        return view('gym-admin.invoice.generate_invoice', $this->data);
    }

    public function downloadInvoice($id) {
        if (!$this->data['user']->can("view_invoice")) {
            return App::abort(401);
        }

        header('Content-type: application/pdf');

        $this->data['invoice'] = GymInvoice::byInvoiceId($id, $this->data['user']->detail_id);
        $this->data['settings'] = GymSetting::GetMerchantInfo($this->data['user']->detail_id);

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('gym-admin.pdf.invoice', $this->data);
        $filename = $this->data['merchantBusiness']->business->slug . '-' . $this->data['invoice']->invoice_number;

        if ($this->data['isPhone'])
            return $pdf->stream();
        else
            return $pdf->download($filename.'.pdf');

    }

    public function emailInvoice(Request $request) {
        $id = $request->input('invoiceId');

        $this->data['invoice'] = GymInvoice::byInvoiceId($id, $this->data['user']->detail_id);
        $this->data['settings'] = GymSetting::GetMerchantInfo($this->data['user']->detail_id);

        if (trim($request->input('client_email')) == '') {
            return Reply::error("Enter client's email address.");
        }

        if (!filter_var($request->input('client_email'), FILTER_VALIDATE_EMAIL)) {
            return Reply::error("Enter valid email address.");
        }


        $pdf = app('dompdf.wrapper');
        $files = $pdf->loadView('gym-admin.pdf.invoice', $this->data)->save('admin/email-attachments/invoices/invoice-' . $this->data['invoice']->invoice_number . '.pdf');
        $filename = $this->data['merchantBusiness']->business->slug . '-' . $this->data['invoice']->invoice_number;


        $email = $request->input('client_email');
        $eText = "Please find your invoice in the attachment.";
        $eTitle = ucwords($this->data['invoice']->business->title) . ' - Invoice #' . $this->data['invoice']->invoice_number;
        $eHeading = ucwords($this->data['invoice']->business->title) . ' - Invoice #' . $this->data['invoice']->invoice_number;


        // For Mail
        $this->emailNotificationAttachment($email, $eText, $eTitle, $eHeading, null, 'admin/email-attachments/invoices/invoice-' . $this->data['invoice']->invoice_number . '.pdf');


        return Reply::success('Invoice sent by email.');


        //return $pdf->stream();
    }

    public function destroy($id, Request $request) {
        if (!$this->data['user']->can("delete_invoice")) {
            return App::abort(401);
        }

        if ($request->ajax()) {
            GymInvoice::destroy($id);
            return Reply::success('Invoice deleted successfully');
        }

        return Reply::error('Request not Valid');
    }

    /**
     * Generate Invoice from payment
     * */

    public function generatePaymentInvoice($id) {
        if (!$this->data['user']->can("create_invoice")) {
            return App::abort(401);
        }

        $this->data['title'] = 'Invoices';
        $this->data['payment'] = GymMembershipPayment::find($id);

        if (is_null($this->data['payment'])) {
            $this->data['item_name'] = $this->data['payment']->purchase->membership->title;
            $this->data['item_price'] = $this->data['payment']->payment_amount;
            $this->data['discount'] = 0;
        }
        else {
            $this->data['item_name'] = $this->data['payment']->purchase->membership->title;
            $this->data['item_price'] = $this->data['payment']->payment_amount;
            $this->data['discount'] = 0;
        }

        $this->data['memberships'] = GymMembership::membershipByBusiness($this->data['user']->detail_id);

        return view('gym-admin.invoice.create_payment_invoice', $this->data);
    }

    public function updateGstNumber() {
        $validator  = Validator::make(Input::all(),GymSetting::rules('update'));

        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }
        $setting = GymSetting::firstOrNew(['detail_id' => $this->data['user']->detail_id]);
        $setting->gstin = Input::get('gstin');
        $setting->save();
        return Reply::success('GST Number updated');
    }

}
