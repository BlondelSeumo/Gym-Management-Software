<?php

namespace App\Http\Controllers\Customer;

use App\Models\GymClient;
use App\Models\GymInvoice;
use App\Models\GymInvoiceItems;
use App\Models\GymMembership;
use App\Models\GymMembershipPayment;
use App\Models\GymPurchase;
use App\Models\GymSetting;
use App\Models\Merchant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CustomerPaymentController extends CustomerBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['paymentMenu'] = 'active';
        $this->data['paymentSubMenu'] = 'active';

        return view('customer-app.payments.index', $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function duePayments()
    {
        $this->data['paymentMenu'] = 'active';
        $this->data['duePaymentMenu'] = 'active';
        $this->data['paymentSubMenu'] = 'inactive';

        return view('customer-app.payments.due-payment', $this->data);
    }

    /**
     * @return mixed
     */
    public function getPaymentData()
    {
        $payments = GymMembershipPayment::select('gym_membership_payments.id as pid', 'gym_clients.first_name', 'gym_clients.last_name', 'payment_amount', 'gym_memberships.title as membership', 'payment_source', 'payment_date', 'payment_id', 'merchant_custom_payment_type.name as payment_type', 'purchase_id')
            ->leftJoin('gym_client_purchases', 'gym_client_purchases.id', '=', 'gym_membership_payments.purchase_id')
            ->leftJoin('merchant_custom_payment_type', 'gym_membership_payments.payment_type', '=', 'merchant_custom_payment_type.id')->leftJoin('gym_clients', 'gym_clients.id', '=', 'gym_membership_payments.user_id')
            ->leftJoin('gym_memberships', 'gym_memberships.id', '=', 'gym_client_purchases.membership_id')
            ->where('gym_membership_payments.user_id', '=', $this->data['customerValues']->id);


        return Datatables::of($payments)->edit_column('first_name', function ($row) {
            return ucwords($row->first_name . ' ' . $row->last_name);
        })->edit_column('payment_source', function ($row) {
            if ($row->payment_source == 'cash') {
                return "<div class='font-dark'> Cash <i class='fa fa-money'></i> </div>";
            }
            if ($row->payment_source == 'credit_card') {
                return "<div class='font-dark'> Credit Card <i class='fa fa-credit-card'></i> </div>";
            }
            if ($row->payment_source == 'debit_card') {
                return "<div class='font-dark'> Debit Card <i class='fa fa-cc-visa'></i> </div>  ";
            }
            else {
                return "<div class='font-dark'> Net Banking <i class='fa fa-internet-explorer '></i> </div>";
            }
        })->edit_column('payment_date', function ($row) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $row->payment_date)->toFormattedDateString();
        })->edit_column('payment_amount', function ($row) {
            return '<i class="fa '.$this->data['gymSettings']->currency->symbol.'"></i>' . $row->payment_amount;
        })->edit_column('payment_id', function ($row) {
            return '<b>' . $row->payment_id . '</b>';
        })->edit_column('payment_type', function ($row) {
            if (is_null($row->payment_type)) {
                return 'Membership';
            }
            return ucfirst($row->payment_type);
        })->add_column('action', function ($row) {

            return '<a href="'.route('customer-app.payments.download-invoice', [$row->pid]).'" class="btn btn-sm btn-info waves-effect">Download Invoice</button>';

        })->remove_column('last_name')
            ->remove_column('pid')
            ->remove_column('package')
            ->remove_column('payment_frequency')
            ->remove_column('purchase_id')
            ->remove_column('membership')
            ->rawColumns([0,1,2,3,4,5,6])
            ->make(true);
    }

    /**
     * @return mixed
     */
    public function getDuePaymentData()
    {
        $dt = Carbon::now('Asia/Calcutta');
        $date = $dt->format('Y-m-d');
        $purchase = GymPurchase::select('first_name', 'last_name', 'gym_client_purchases.amount_to_be_paid as amount_to_be_paid', 'gym_client_purchases.purchase_amount as purchase_amount', 'gym_client_purchases.paid_amount as paid', 'gym_client_purchases.discount as discount', 'next_payment_date as due_date', 'gym_memberships.title as membership', 'gym_client_purchases.id')
            ->leftJoin('gym_clients', 'gym_clients.id', '=', 'client_id')
            ->leftJoin('gym_memberships', 'gym_memberships.id', '=', 'membership_id')
            ->where('gym_client_purchases.client_id', '=', $this->data['customerValues']->id)
            ->where('gym_client_purchases.next_payment_date', '<=', $date)
            ->where('gym_client_purchases.next_payment_date', '!=', '0000-00-00');


        return Datatables::of($purchase)
            ->edit_column('first_name', function ($row) {
                return $row->first_name . ' ' . $row->last_name;
            })
            ->edit_column('purchase_amount', function ($row) {
                return '<i class="fa '.$this->data['gymSettings']->currency->symbol.'"></i>' .$row->amount_to_be_paid;
            })
            ->edit_column('remaining_amount', function ($row) {
                 return '<i class="fa '.$this->data['gymSettings']->currency->symbol.'"></i>' .($row->purchase_amount - $row->paid);
            })
            ->edit_column('discount', function ($row) {
                return '<i class="fa '.$this->data['gymSettings']->currency->symbol.'"></i>' .$row->discount;
            })
            ->edit_column('due_date', function ($row) {
                return Carbon::createFromFormat('Y-m-d', $row->due_date)->toFormattedDateString();
            })
            ->remove_column('paid')
            ->remove_column('last_name')
            ->remove_column('membership')
            ->remove_column('package')
            ->remove_column('id')
            ->rawColumns([0,1])
            ->make(true);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function downloadInvoice($id)
    {
        $purchase = GymPurchase::find($id);
        $membership = GymMembership::find($purchase->membership_id);
        $clientDetails = GymClient::find($purchase->client_id);
        $merchant = Merchant::where('is_admin', '=', 1)->first();

        $invoiceId = $this->saveInvoice($merchant, $purchase, $clientDetails);
        $this->saveInvoiceItems($invoiceId, $membership, $purchase);

        header('Content-type: application/pdf');

        $this->data['invoice'] = GymInvoice::byInvoiceId($invoiceId, $this->data['customerValues']->detail_id);
        $this->data['settings'] = GymSetting::GetMerchantInfo($this->data['customerValues']->detail_id);

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('customer-app.payments.invoice', $this->data);
        $filename = $this->data['customerBusiness']->business->slug . '-' . $this->data['invoice']->invoice_number;

        if ($this->data['isPhone'])
            return $pdf->stream();
        else
            return $pdf->download($filename.'.pdf');
    }

    /**
     * @param $merchant
     * @param $purchase
     * @param $clientDetails
     * @return mixed
     */
    public function saveInvoice($merchant, $purchase, $clientDetails)
    {
        $invoice = new GymInvoice();
        $invoice->merchant_id = $merchant->id;
        $invoice->detail_id = $purchase->detail_id;
        $invoice->client_name = $clientDetails->first_name.' '.$clientDetails->last_name;
        $invoice->client_address = $clientDetails->address;
        $invoice->email = $clientDetails->email;
        $invoice->mobile = $clientDetails->mobile;
        $invoice->invoice_date = Carbon::now()->format('Y-m-d');
        $invoice->sub_total = $purchase->paid_amount;
        $invoice->discount_amount = $purchase->discount;
        $invoice->total = $purchase->paid_amount;
        $invoice->generated_by = $clientDetails->first_name.' '.$clientDetails->last_name;
        $invoice->save();

        $invoice->invoice_number = strtoupper(str_random(5)) . $invoice->id;
        $invoice->save();

        return $invoice->id;
    }

    /**
     * @param $invoiceId
     * @param $membership
     * @param $purchase
     */
    public function saveInvoiceItems($invoiceId, $membership, $purchase)
    {
        $invoiceItems = new GymInvoiceItems();
        $invoiceItems->invoice_id = $invoiceId;
        $invoiceItems->item_type = 'item';
        $invoiceItems->item_name = $membership->title;
        $invoiceItems->quantity = 1;
        $invoiceItems->cost_per_item = $purchase->paid_amount;
        $invoiceItems->amount = $purchase->paid_amount;
        $invoiceItems->save();
    }
}
