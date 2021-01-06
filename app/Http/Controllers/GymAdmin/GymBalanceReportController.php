<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Models\GymExpense;
use App\Models\GymMembershipPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class GymBalanceReportController extends GymAdminBaseController
{

    public function __construct() {
        parent::__construct();
        $this->data['reportMenu'] = 'active';
        $this->data['balancereportMenu'] = 'active';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!$this->data['user']->can("balance_report")) {
            return App::abort(401);
        }

        $this->data['title'] = 'Balance Report';
        $this->data['income'] = GymMembershipPayment::getLastSixMonthBalance($this->data['user']->detail_id);
        $this->data['expense'] = GymExpense::getExpenses($this->data['user']->detail_id);
        $chartDataIncome = GymMembershipPayment::select(DB::raw('sum(payment_amount) as income, MONTHNAME(payment_date) as month, DATE_FORMAT(payment_date, \'%y\') as year'))
            ->where('detail_id', '=', $this->data['user']->detail_id)
            ->where('payment_date', '>', Carbon::now()->subMonths(6)->format('Y-m-d'))
            ->orderBy('MONTH', 'desc')
            ->groupBy('MONTH')
            ->get();
        $chartDataExpense = GymExpense::select(DB::raw('sum(price) as expense, MONTHNAME(purchase_date) as month, DATE_FORMAT(purchase_date, \'%y\') as year'))
            ->where('detail_id', '=', $this->data['user']->detail_id)
            ->where('purchase_date', '>', Carbon::now()->subMonths(6)->format('Y-m-d'))
            ->groupBy('MONTH')
            ->orderBy('MONTH', 'desc')
            ->get();

        $data = [];
        foreach($chartDataExpense as $chartExpense) {
            foreach($chartDataIncome as $chartIncome) {
                if ($chartExpense->month == $chartIncome->month) {
                    $data[$chartIncome->month.' '.$chartIncome->year] = [
                        'month' => $chartExpense->month.' '.$chartExpense->year,
                        'expense' => round($chartExpense->expense, 2),
                        'income' => round($chartIncome->income, 2),
                    ];
                } elseif ($chartExpense->month) {
                    $data[$chartExpense->month.' '.$chartExpense->year] = [
                        'month' => $chartExpense->month.' '.$chartExpense->year,
                        'expense' => round($chartExpense->expense, 2),
                        'income' => 0,
                    ];
                } elseif ($chartIncome->month) {
                    $data[$chartIncome->month.' '.$chartIncome->year] = [
                        'month' => $chartIncome->month.' '.$chartIncome->year,
                        'expense' => 0,
                        'income' => round($chartIncome->income, 2),
                    ];
                }
            }
        }

        $months = [];
        for($i = 0; $i < 6; $i++ ) {
            if(Carbon::now()->format('d') == 31) {
                $months [] = Carbon::now()->subDay()->subMonths($i)->format('F y');
            } else {
                $months [] = Carbon::now()->subMonths($i)->format('F y');
            }

        }
        $finalData = [];
        foreach($months as $month) {
            if(isset($data[$month])) {
                $finalData[] = $data[$month];
            } else {
                $finalData[] = [
                    'month' => $month,
                    'expense' => 0,
                    'income' => 0,
                ];
            }
        }
        $information = array_reverse($finalData);
        $this->data['information'] = \GuzzleHttp\json_encode($information);

        return View::make('gym-admin.reports.balance.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $chartDataIncomes = GymMembershipPayment::select(DB::raw('sum(payment_amount) as income, MONTHNAME(payment_date) as month, DATE_FORMAT(payment_date, \'%y\') as year'))
            ->where('detail_id', '=', $this->data['user']->detail_id)
            ->whereBetween('payment_date', [$request->startDate, $request->endDate])
            ->orderBy('MONTH', 'desc')
            ->groupBy('MONTH')
            ->get();
        $chartDataExpenses = GymExpense::select(DB::raw('sum(price) as expense, MONTHNAME(purchase_date) as month, DATE_FORMAT(purchase_date, \'%y\') as year'))
            ->where('detail_id', '=', $this->data['user']->detail_id)
            ->whereBetween('purchase_date', [$request->startDate, $request->endDate])
            ->groupBy('MONTH')
            ->orderBy('MONTH', 'desc')
            ->get();

        $data = [];
        if(count($chartDataExpenses) > 0 && count($chartDataIncomes) > 0) {
            foreach($chartDataExpenses as $chartExpense) {
                foreach($chartDataIncomes as $chartIncome) {
                    if ($chartExpense->month == $chartIncome->month) {
                        $data[$chartExpense->month.' '.$chartExpense->year] = [
                            'month' => $chartExpense->month.' '.$chartExpense->year,
                            'expense' => round($chartExpense->expense, 2),
                            'income' => round($chartIncome->income, 2),
                        ];
                    } elseif ($chartExpense->month) {
                        $data[$chartExpense->month.' '.$chartExpense->year] = [
                            'month' => $chartExpense->month.' '.$chartExpense->year,
                            'expense' => round($chartExpense->expense, 2),
                            'income' => 0,
                        ];
                    } elseif ($chartIncome->month) {
                        $data[$chartIncome->month.' '.$chartIncome->year] = [
                            'month' => $chartIncome->month.' '.$chartIncome->year,
                            'expense' => 0,
                            'income' => round($chartIncome->income, 2),
                        ];
                    }
                }
            }
        } elseif(count($chartDataIncomes) > 0) {
            foreach($chartDataIncomes as $chartIncome) {
                $data[$chartIncome->month.' '.$chartIncome->year] = [
                    'month' => $chartIncome->month.' '.$chartIncome->year,
                    'expense' => 0,
                    'income' => round($chartIncome->income, 2),
                ];
            }
        } elseif(count($chartDataExpenses) > 0) {
            foreach($chartDataExpenses as $chartExpense) {
                $data[$chartExpense->month.' '.$chartExpense->year] = [
                    'month' => $chartExpense->month.' '.$chartExpense->year,
                    'expense' => round($chartExpense->expense, 2),
                    'income' => 0,
                ];
            }
        }

        $startMonth = Carbon::createFromFormat('Y-m-d', $request->startDate);
        $endMonth = Carbon::createFromFormat('Y-m-d', $request->endDate);
        $differenceInMonths = $startMonth->diffInMonths($endMonth);
        $months = [];
        $months [] = Carbon::createFromFormat('Y-m-d', $request->startDate)->format('F y');
        for($i = 1 ;$i < $differenceInMonths; $i++) {
            $months [] = Carbon::createFromFormat('Y-m-d', $request->startDate)->addMonth($i)->format('F y');
        }
        $months [] = Carbon::createFromFormat('Y-m-d', $request->endDate)->format('F y');
        $finalData = [];
        foreach($months as $month) {
            if(isset($data[$month])) {
                $finalData[] = $data[$month];
            } else {
                $finalData[] = [
                    'month' => $month,
                    'expense' => 0,
                    'income' => 0,
                ];
            }
        }
        $expense = 0;
        $income = 0;
        foreach ($chartDataExpenses as $chartDataExpense) {
            $expense += $chartDataExpense->expense;
        }

        foreach ($chartDataIncomes as $chartDataIncome) {
            $income += $chartDataIncome->income;
        }

        $this->data['information'] = \GuzzleHttp\json_encode($finalData);
        $totalExpense = round($expense, 2);
        $totalIncome = round($income, 2);

        return Reply::dataOnly(['totalExpense'=> $totalExpense, 'totalIncome' => $totalIncome, 'information' => $this->data['information']]);
    }
}
