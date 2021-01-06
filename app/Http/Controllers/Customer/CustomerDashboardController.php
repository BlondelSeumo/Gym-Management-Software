<?php

namespace App\Http\Controllers\Customer;

use App\Classes\Reply;
use App\Models\GymClient;
use App\Models\GymMembership;
use App\Models\GymMembershipPayment;
use App\Models\GymPurchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerDashboardController extends CustomerBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'Fitsigma | Customer Dashboard';
        $this->data['dashboardMenu'] = 'active';
        $this->data['totalAmountPaid'] = GymMembershipPayment::leftJoin('gym_client_purchases', 'gym_client_purchases.id', '=', 'purchase_id')
            ->leftJoin('gym_clients', 'gym_clients.id', '=', 'gym_membership_payments.user_id')
            ->where('gym_clients.id', '=', $this->data['customerValues']->id)
            ->sum('payment_amount');
        $this->data['totalSubscriptions'] = GymMembershipPayment::leftJoin('gym_clients', 'gym_clients.id', '=', 'gym_membership_payments.user_id')
            ->where('gym_clients.id', '=', $this->data['customerValues']->id)
            ->where('gym_membership_payments.detail_id', '=', $this->data['customerValues']->detail_id)
            ->count();
        $this->data['expiringSubscriptions'] = GymPurchase::select('first_name', 'last_name', 'gym_clients.image', 'gym_client_purchases.expires_on', 'gym_memberships.title as membership', 'gym_client_purchases.id')
            ->leftJoin('gym_clients', 'gym_clients.id', '=', 'client_id')
            ->leftJoin('gym_memberships', 'gym_memberships.id', '=', 'membership_id')
            ->where('gym_client_purchases.detail_id', '=', $this->data['customerValues']->detail_id)
            ->where('gym_clients.id', '=', $this->data['customerValues']->id)
            ->where('gym_client_purchases.expires_on', '<=', Carbon::today()->addDays(45))
            ->where('gym_client_purchases.expires_on', '>=', Carbon::today())
            ->orderBy('gym_client_purchases.expires_on', 'asc')
            ->get();
        $dt = Carbon::now('Asia/Calcutta');
        $date = $dt->format('Y-m-d');
        $this->data['duePayments'] = GymPurchase::select('first_name', 'last_name', 'gym_clients.image', 'gym_client_purchases.amount_to_be_paid as amount_to_be_paid', 'gym_client_purchases.purchase_amount as purchase_amount', 'gym_client_purchases.paid_amount as paid', 'gym_client_purchases.discount as discount', 'next_payment_date as due_date', 'gym_memberships.title as membership', 'gym_client_purchases.id')
            ->leftJoin('gym_clients', 'gym_clients.id', '=', 'client_id')
            ->leftJoin('gym_memberships', 'gym_memberships.id', '=', 'membership_id')
            ->where('gym_client_purchases.detail_id', '=', $this->data['customerValues']->detail_id)
            ->where('gym_clients.id', '=', $this->data['customerValues']->id)
            ->where('gym_client_purchases.next_payment_date', '<=', $date)
            ->where('gym_client_purchases.next_payment_date', '!=', '0000-00-00')
            ->get();
        $this->data['paymentCharts'] = GymMembershipPayment::Select(DB::raw('SUM(payment_amount)as S, MONTH(payment_date) as M'))
            ->leftJoin('gym_clients', 'gym_clients.id', '=', 'user_id')
            ->where('gym_clients.id', '=', $this->data['customerValues']->id)
            ->where('gym_membership_payments.detail_id', '=', $this->data['customerValues']->detail_id)
            ->where(DB::raw('YEAR(payment_date)'), Carbon::today()->year)
            ->groupBy(DB::raw('MONTH(payment_date)'))
            ->get();

        return view('customer-app.dashboard.index', $this->data);
    }

    public function markRead()
    {
        $user = GymClient::find($this->data['customerValues']->id);
        $user->unreadNotifications()->update(['read_at' => Carbon::now()]);

        return Reply::success('Notifications marked as read.');
    }
}
