<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Models\GymClient;
use App\Models\GymClientAttendance;
use App\Models\GymEnquiries;
use App\Models\GymMembership;
use App\Models\GymMembershipPayment;
use App\Models\GymPurchase;
use App\Models\Merchant;
use App\Models\MerchantNotification;
use App\Models\SetTarget;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class AdminGymDashboardController extends GymAdminBaseController
{

    public function __construct() {
        parent::__construct();
        $this->data['dashboardMenu'] = 'active';
    }

    public function index() {

        if(!$this->data['user']->can("view_dashboard"))
        {
            //return App::abort(401);
        }

        $this->data['title'] = "Dashboard";
        $payment = new GymMembershipPayment();
        $now = Carbon::now('Asia/Calcutta');
        $this->data['currentBalance'] = $payment->getCurrentBalance($this->data['user']->detail_id);
        $this->data['weeklySales'] = $payment->getWeeklySales($now->startOfWeek()->format('Y-m-d'), $now->endOfWeek()->addDay()->format('Y-m-d'), $this->data['user']->detail_id);
        $this->data['maxSale'] = $payment->getMaxSale($this->data['user']->detail_id);
        $this->data['averageMonthly'] = $payment->getAverageMonthlySales($now->month, $now->year, $this->data['user']->detail_id);

        $targets = SetTarget::allBusinessTargets($this->data['user']->detail_id)->take(3);
        $targetStats = array();

        foreach($targets as $key => $target) {
            if($target->targetType->type == 'membership'){

                $date = Carbon::createFromFormat('Y-m-d', $target->date);
                $start_date = Carbon::createFromFormat('Y-m-d', $target->start_date);

                $users = GymPurchase::whereBetween('purchase_date', [$start_date->format('Y-m-d'), $date->format('Y-m-d')])
                    ->where('detail_id', '=', $this->data['user']->detail_id)->count();

                $target_achieve_percent  =  ($users/$target->value)*100;
                $targetStats[$key]['name'] = $target->title;
                $targetStats[$key]['percent'] = ($target_achieve_percent > 100) ? 100 : $target_achieve_percent;


            }

            if ($target->targetType->type == 'revenue') {
                $date = Carbon::createFromFormat('Y-m-d', $target->date);
                $start_date = Carbon::createFromFormat('Y-m-d', $target->start_date);

                $sales = GymMembershipPayment::leftJoin('gym_client_purchases', 'gym_client_purchases.id', '=', 'purchase_id')
                    ->whereBetween('payment_date', [$start_date->format('Y-m-d'),$date->format('Y-m-d')])
                    ->where('gym_client_purchases.detail_id', '=', $this->data['user']->detail_id)->sum('payment_amount');
                $target_achieve_percent  =  ($sales/$target->value)*100;
                $targetStats[$key]['name'] = $target->title;
                $targetStats[$key]['percent'] = ($target_achieve_percent > 100) ? 100 : $target_achieve_percent;

            }

        }

        $this->data['targets'] = $targetStats;
        $this->data['financeCharts'] = GymMembershipPayment::Select(DB::raw('SUM(payment_amount)as S, MONTH(payment_date) as M'))
            ->where('gym_membership_payments.detail_id', '=', $this->data['user']->detail_id)
            ->where(DB::raw('YEAR(payment_date)'), Carbon::today()->year)
            ->groupBy(DB::raw('MONTH(payment_date)'))
            ->get();

        $this->data['membershipsStats'] = $this->getMembershipStats();
        $this->data['recentClients'] = GymClient::join('business_customers', 'business_customers.customer_id', '=', 'gym_clients.id')
            ->where('business_customers.detail_id', '=', $this->data['user']->detail_id)
            ->orderBy('gym_clients.created_at', 'desc')
            ->take(3)
            ->get();
        $this->data['notis'] = MerchantNotification::where('detail_id', '=', $this->data['user']->detail_id)->orderBy('created_at', 'desc')->get();

        $this->data['chartData'] = DB::select(DB::raw("Select sum(views) as views, created_at, DATE_FORMAT(created_at, '%b') as month, DATE_FORMAT(created_at, '%y') as year FROM business_monthly_visits WHERE detail_id = ".$this->data['user']->detail_id."  GROUP BY month(created_at) ORDER BY created_at ASC LIMIT 12"));

        $dt = Carbon::now('Asia/Calcutta');
        $date = $dt->format('Y-m-d');
        $this->data['duePayments'] = GymPurchase::select('first_name', 'last_name', 'gym_clients.image', 'gym_client_purchases.amount_to_be_paid as amount_to_be_paid', 'gym_client_purchases.purchase_amount as purchase_amount', 'gym_client_purchases.paid_amount as paid', 'gym_client_purchases.discount as discount', 'next_payment_date as due_date', 'gym_memberships.title as membership', 'gym_client_purchases.id')
            ->leftJoin('gym_clients', 'gym_clients.id', '=', 'client_id')
            ->leftJoin('gym_memberships', 'gym_memberships.id', '=', 'membership_id')
            ->where('gym_client_purchases.detail_id', '=', $this->data['user']->detail_id)
            ->where('gym_client_purchases.next_payment_date', '<=', $date)
            ->where('gym_client_purchases.next_payment_date', '!=', '0000-00-00')
            ->get();

        $this->data['expiringSubscriptions'] = GymPurchase::select('first_name', 'last_name', 'gym_clients.image', 'gym_client_purchases.expires_on', 'gym_memberships.title as membership', 'gym_client_purchases.id')
            ->leftJoin('gym_clients', 'gym_clients.id', '=', 'client_id')
            ->leftJoin('gym_memberships', 'gym_memberships.id', '=', 'membership_id')
            ->where('gym_client_purchases.detail_id', '=', $this->data['user']->detail_id)
            ->where('gym_client_purchases.expires_on', '<=', Carbon::today()->addDays(45))
            ->where('gym_client_purchases.expires_on', '>=', Carbon::today())
            ->orderBy('gym_client_purchases.expires_on', 'asc')
            ->get();

        $this->data['totalCustomers'] = GymClient::join('business_customers', 'business_customers.customer_id', '=', 'gym_clients.id')
            ->where('business_customers.detail_id', '=', $this->data['user']->detail_id)
            ->count();
        $this->data['monthlyVisitors'] = GymEnquiries::monthlyEnquiries($this->data['user']->detail_id, $dt->month);
        $this->data['monthlyCustomers'] = GymClient::monthlyClients($this->data['user']->detail_id, $dt->month);
        $this->data['todayAttendance'] = GymClientAttendance::attendanceByDateCount($date, $this->data['user']->detail_id);

        return View::make('gym-admin.dashboard.index', $this->data);
    }

    /*
	 * mark all notification as read
	 * */

    public function markRead() {
        if (request()->ajax()) {
            MerchantNotification::where('detail_id', '=', $this->data['user']->detail_id)->update(["read_status" => "read"]);
            return Reply::success('Notifications marked as read.');
        }

    }

    public function getMembershipStats() {
        $purchases = GymPurchase::where('detail_id', '=', $this->data['user']->detail_id)->get();
        $memberships = array();

        foreach ($purchases as $purchase) {
            if($purchase->membership_id != null)
            {
                array_push($memberships, $purchase->membership_id);
            }
        }

        $memberships = array_count_values($memberships);

        $memberships_id = array_keys($memberships);
        $data = GymMembership::whereIn('id', $memberships_id)->get()->toArray();

        foreach ($data as $key => $membership) {
            $data[$key]['total'] = $memberships[$membership['id']];
        }

        return $data;
    }

    /**
     * Accept terms & conditions
     * */
    public function acceptTerms() {
        if(request()->ajax()) {
            $merchant = Merchant::find($this->data['user']->id);
            $merchant->agree_terms = Carbon::now('Asia/Calcutta');
            $merchant->save();

            return Reply::success('Terms & conditions accepted successfully.');
        }
        else{
            return "Illegal request method.";
        }
    }

}
