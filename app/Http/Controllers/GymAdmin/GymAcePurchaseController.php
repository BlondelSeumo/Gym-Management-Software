<?php

namespace App\Http\Controllers\GymAdmin;

use App\Models\AcePurchase;
use App\Models\GymSetting;
use App\Models\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Yajra\Datatables\Facades\Datatables;

class GymAcePurchaseController extends GymAdminBaseController
{

    public function index() {
        if (!$this->data['user']->can("view_billing_history")) {
            return App::abort(401);
        }

        $this->data['title'] = "Billing History";
        return view('gym-admin.ace_purchase.index', $this->data);
    }

    public function create() {
        if (!$this->data['user']->can("view_billing_history")) {
            return App::abort(401);
        }

        $purchases = AcePurchase::select('ace_purchases.id', 'ace_plans.plan_name', 'grand_total', 'purchase_id', 'payment_method', 'plan_starts_on', 'plan_expires_on', 'ace_purchases.created_at')
            ->leftJoin('ace_plans', 'ace_plans.id', '=', 'ace_purchases.plan_id')
            ->where('detail_id', '=', $this->data['merchantBusiness']->detail_id)
            ->where('status', 'paid')
            ->orderBy('id', 'desc');

        return Datatables::of($purchases)->add_column('action', function ($row) {

            return '<a href="' . route('gym-admin.ace-purchase.download-invoice', $row->id) . '" class="btn btn-sm blue"> <i class="fa fa-download"></i> Download</a>';
        })
            ->edit_column('plan_starts_on', function ($row) {
                return $row->plan_starts_on->toFormattedDateString();
            })
            ->edit_column('grand_total', function ($row) {
                return '<i class="fa '.$this->data['gymSettings']->currency->symbol.'"></i>' . $row->grand_total;
            })
            ->edit_column('plan_expires_on', function ($row) {
                return $row->plan_expires_on->toFormattedDateString();
            })
            ->edit_column('plan_name', function ($row) {
                return ucwords($row->plan_name);
            })
            ->edit_column('created_at', function ($row) {
                return $row->created_at->toFormattedDateString();
            })
            ->remove_column('id')
            ->rawColumns([1,7])
            ->make();
    }

    public function downloadInvoice($id) {
        header('Content-type: application/pdf');

        $this->data['invoice'] = AcePurchase::getInvoiceDetails($this->data['user']->detail_id, $id);
        $this->data['settings'] = GymSetting::GetMerchantInfo($this->data['user']->detail_id);
        $this->data['frontLogo'] = Setting::first()->logo;

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('gym-admin.pdf.ace_purchase_invoice', $this->data);
        $filename = $this->data['merchantBusiness']->business->slug . '-' . $this->data['invoice']->purchase_id;

        if ($this->data['isPhone']):
            return $pdf->stream();
        else:
            return $pdf->download($filename . '.pdf');
        endif;
    }

}
