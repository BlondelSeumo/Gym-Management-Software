<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Http\Requests\GymAdmin\BranchSetup\BranchStoreRequest;
use App\Http\Requests\GymAdmin\BranchSetup\BranchUpdateRequest;
use App\Http\Requests\GymAdmin\BranchSetup\ManagerStoreRequest;
use App\Http\Requests\GymAdmin\BranchSetup\PermissionStoreRequest;
use App\Http\Requests\GymAdmin\BranchSetup\RoleAndPermissionUpdateRequest;
use App\Http\Requests\GymAdmin\BranchSetup\RoleStoreRequest;
use App\Models\BusinessBranch;
use App\Models\BusinessCategory;
use App\Models\Category;
use App\Models\Common;
use App\Models\GymClient;
use App\Models\GymEnquiries;
use App\Models\GymExpense;
use App\Models\GymMembershipPayment;
use App\Models\GymMerchantPermission;
use App\Models\GymMerchantPermissionRole;
use App\Models\GymMerchantRole;
use App\Models\GymMerchantRoleUser;
use App\Models\GymPurchase;
use App\Models\GymSetting;
use App\Models\Merchant;
use App\Models\MerchantBusiness;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Facades\Datatables;

class GymSuperAdminController extends GymAdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['indexSuperAdmin'] = 'active';
        $this->data['title'] = 'Manage Branches';

        return view('gym-admin.super-admin.index', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['title'] = "Manage Branches - Edit Branch";
        $this->data['branchData'] = Common::find($id);
        $this->data['roles'] = GymMerchantRole::where('detail_id', $this->data['user']->detail_id)
            ->select('id', 'name')
            ->get();

        $this->data['managers'] = Merchant::select('merchants.id', 'merchants.first_name', 'merchants.last_name')
            ->leftJoin('merchant_businesses', 'merchant_businesses.merchant_id', '=', 'merchants.id')
            ->where('merchant_businesses.detail_id', '=', $id)
            ->get();

        return view('gym-admin.super-admin.edit-branch', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BranchUpdateRequest $request, $id)
    {
        //region Update Branch Details
        $branchUpdateData = Common::find($id);
        $branchUpdateData->title = $request->title;
        $branchUpdateData->address = $request->address;
        $branchUpdateData->owner_incharge_name = $request->owner_incharge_name;
        $branchUpdateData->phone = $request->phone;
        $branchUpdateData->email = $request->email;
        $branchUpdateData->save();
        //endregion

        return Reply::redirect(route('gym-admin.superadmin.index'), 'Branch is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MerchantBusiness::select('merchant_id')
        ->leftJoin('merchants', 'merchants.id', '=', 'merchant_businesses.merchant_id')
        ->where('merchant_businesses.detail_id', '=', $id)
        ->where('merchants.is_admin', '=', 0)
        ->delete();
        $branch = Common::count();
        if($branch > 1) {
            Common::destroy($id);
            return Reply::success('Branch is deleted successfully.');
        }

        return Reply::error('Branch cannot be deleted. There should be at least one branch');
    }

    public function showDashboard()
    {
        $this->data['superAdminMenu'] = 'active';
        $this->data['title'] = 'Super Admin';
        $this->data['branchCount'] = Common::count();
        $this->data['customerCount'] = GymClient::count();
        $this->data['totalEarnings'] = GymMembershipPayment::leftJoin('gym_client_purchases', 'gym_client_purchases.id', '=', 'purchase_id')
            ->sum('payment_amount');
        $this->data['currentMonthEarnings'] = GymMembershipPayment::whereBetween('gym_membership_payments.payment_date', [Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d')])
            ->sum('payment_amount');
        $this->data['currentMonthEnquiries'] = GymEnquiries::whereBetween('enquiry_date', [Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d')])
            ->count();
        $this->data['unpaidMembers'] = GymPurchase::where('next_payment_date', '<=', Carbon::now()->format('Y-m-d'))
            ->where('next_payment_date', '!=', '0000-00-00')
            ->count();
        $this->data['duePayments'] = GymPurchase::where('next_payment_date', '<=', Carbon::now()->format('Y-m-d'))
            ->where('next_payment_date', '!=', '0000-00-00')
            ->sum(DB::raw('amount_to_be_paid - paid_amount'));
        $this->data['currentMonthExpense'] = GymExpense::whereBetween('purchase_date', [Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d')])
            ->sum('price');
        $this->data['recentCustomers'] = GymClient::join('business_customers', 'business_customers.customer_id', '=', 'gym_clients.id')
            ->join('common_details', 'common_details.id', 'business_customers.detail_id')
            ->orderBy('gym_clients.created_at', 'desc')
            ->take(20)
            ->get();
        $this->data['recentPayments'] = GymMembershipPayment::orderBy('payment_date', 'desc')
            ->take(20)
            ->get();
        $this->data['monthName'] = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June',
            7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];

        $yearList = [];
        $current_year = date('Y');
        $min_year = $current_year - 3;
        for($year = $min_year; $year <= $current_year; $year++) {
            array_push($yearList, $year);
        }

        $this->data['years'] = $yearList;

        $incomes = GymMembershipPayment::select(DB::raw('sum(payment_amount) as income, MONTHNAME(payment_date) as month, DATE_FORMAT(payment_date, \'%y\') as year'))
            ->whereBetween('payment_date', [Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d')])
            ->orderBy('MONTH', 'desc')
            ->groupBy('MONTH')
            ->get();

        $expenses = GymExpense::select(DB::raw('sum(price) as expense, MONTHNAME(purchase_date) as month, DATE_FORMAT(purchase_date, \'%y\') as year'))
            ->whereBetween('purchase_date', [Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d')])
            ->groupBy('MONTH')
            ->orderBy('MONTH', 'desc')
            ->get();

        $expenseArray = [];
        foreach ($expenses as $expense) {
            $temp = [
                'month' => $expense->month.' '.$expense->year,
                'expense' => $expense->expense,
            ];
            array_push($expenseArray, $temp);
        }

        $incomeArray = [];
        foreach ($incomes as $income) {
            $temp = [
                'month' => $income->month.' '.$income->year,
                'income' => $income->income,
            ];
            array_push($incomeArray, $temp);
        }

        $data = array_replace_recursive($incomeArray, $expenseArray);
        $this->data['earningExpenseChart'] = \GuzzleHttp\json_encode(array_reverse($data));

        $clientRegisters = GymClient::select(DB::raw('count(joining_date) as client, MONTHNAME(joining_date) as month, DATE_FORMAT(joining_date, \'%y\') as year'))
            ->where('joining_date', '>', Carbon::now()->subMonths(2)->format('Y-m-d'))
            ->groupBy('MONTH')
            ->orderByRaw('joining_date DESC')
            ->get();

        $clientInformation = [];
        if(count($clientRegisters) > 0) {
            foreach ($clientRegisters as $clientRegister) {
                $temp = [
                    'month' => $clientRegister->month.' '.$clientRegister->year,
                    'client' => $clientRegister->client,
                ];
                array_push($clientInformation, $temp);
            }
        }

        $this->data['clientRegisterChart'] = \GuzzleHttp\json_encode(array_reverse($clientInformation));
        
        return view('gym-admin.super-admin.dashboard', $this->data);
    }

    public function getData()
    {
        $branches = Common::select('common_details.id', 'common_details.title')
            ->leftJoin('business_branches', 'business_branches.detail_id', '=','common_details.id');

        return Datatables::of($branches)->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                    <button class="btn blue btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-gears"></i> <span class="hidden-xs">Actions</span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="' . route('gym-admin.superadmin.edit', $row->id) . '"> <i class="fa fa-edit"></i>Edit Branch</a>
                        </li>
                        <li>
                            <a href="javascript:;" onclick="deleteModal(' . $row->id . ')"> <i class="fa fa-trash"></i>Delete Branch</a>
                        </li>
                    </ul>
                </div>';
            })
            ->remove_column('id')
            ->rawColumns([0,1,2,3])
            ->make(true);
    }

    public function branchPage($id = null)
    {
        $this->data['title'] = "Manage Branches - Add Branch";
        $this->data['completedItems'] = 1;
        $this->data['completedItemsRequired'] = 5;
        $this->data['manager_id'] = session('manager_id');
        $this->data['branchData'] = Common::find($id);

        return view('gym-admin.super-admin.create-branches.branch', $this->data);
    }

    public function storeBranchPage(BranchStoreRequest $request)
    {
        //region Common Detail
        $branch = Common::firstOrNew(['id' => $request->get('branch_id')]);
        $branch->title = $request->title;
        $branch->owner_incharge_name = $request->owner_incharge_name;
        $branch->address = $request->address;
        $branch->phone = $request->phone;
        $branch->email = $request->email;
        $branch->save();
        //endregion

        //region Business Branch
        $businessBranch = BusinessBranch::firstorNew(['detail_id' => $request->get('branch_id')]);
        $businessBranch->detail_id = $branch->id;
        $businessBranch->owner_incharge_name = $branch->owner_incharge_name;
        $businessBranch->address = $branch->address;
        $businessBranch->phone = $branch->phone;
        $businessBranch->save();
        //endregion

        //region Category
        $category = Category::first();
        //endregion

        //region Business Category
        $businessCategory = BusinessCategory::firstorNew(['detail_id' => $request->get('branch_id')]);
        $businessCategory->category_id = $category->id;
        $businessCategory->detail_id = $branch->id;
        $businessCategory->save();
        //endregion

        //region Gym Setting
        $gymSetting =  GymSetting::firstorNew(['detail_id' => $request->get('branch_id')]);
        $gymSetting->detail_id = $branch->id;
        $gymSetting->currency_id = $this->data['gymSettings']->currency_id;
        $gymSetting->save();
        //endregion

        session(['branch_id' => $branch->id]);

        return Reply::redirect(route('gym-admin.superadmin.manager'), 'Branch is added successfully.');
    }

    public function managerPage($id = null)
    {
        $this->data['title'] = "Manage Branches - Add Manager";
        $this->data['completedItems'] = 2;
        $this->data['completedItemsRequired'] = 5;
        $this->data['branch_id'] = session('branch_id');
        $this->data['managerData'] = Merchant::find($id);

        return view('gym-admin.super-admin.create-branches.manager', $this->data);
    }

    public function storeManagerPage(ManagerStoreRequest $request)
    {
        //region Merchant
        $manager = Merchant::firstOrNew(['id' => $request->get('manager_id')]);
        $manager->first_name = $request->first_name;
        $manager->last_name = $request->last_name;
        $manager->email = $request->email;
        $manager->gender = $request->gender;
        $manager->mobile = $request->mobile;
        $manager->date_of_birth = $request->date_of_birth;
        if(!is_null($request->get('password'))) {
            $manager->password = Hash::make($request->password);
        }
        $manager->username = $request->username;
        $manager->save();
        //endregion

        //region Merchant Business
        $merchantBusiness = MerchantBusiness::firstorNew(
            ['merchant_id' => $manager->id],
            ['detail_id' => $request->get('branch_id')]
        );
        $merchantBusiness->detail_id = $request->get('branch_id');
        $merchantBusiness->merchant_id = $manager->id;
        $merchantBusiness->save();
        //endregion

        session(['manager_id' => $manager->id]);

        return Reply::redirect(route('gym-admin.superadmin.role'), 'Manager is added successfully.');
    }

    public function rolePage($id = null)
    {
        $this->data['title'] = "Manage Branches - Add Role";
        $this->data['completedItems'] = 3;
        $this->data['completedItemsRequired'] = 5;
        $this->data['manager_id'] = session('manager_id');
        $this->data['branchData'] = Common::find(session('branch_id'));
        $this->data['role'] = GymMerchantRole::find($id);

        return view('gym-admin.super-admin.create-branches.role', $this->data);
    }

    public function storeRolePage(RoleStoreRequest $request)
    {
        //region Gym Merchant Role
        $gymManagerRole = GymMerchantRole::firstorNew(['id' => $request->get('role_id')]);
        $gymManagerRole->detail_id = $request->branch_id;
        $gymManagerRole->name = $request->role;
        $gymManagerRole->save();
        //endregion
        session(['role_id' => $gymManagerRole->id]);

        return Reply::redirect(route('gym-admin.superadmin.permission'), 'Role is added successfully.');
    }

    public function permissionPage($id = null)
    {
        $this->data['title'] = "Manage Branches - Add Permissions";
        $this->data['completedItems'] = 4;
        $this->data['completedItemsRequired'] = 5;
        $this->data['manager_id'] = session('manager_id');
        $this->data['branch_id'] = session('branch_id');
        $this->data['roles'] = GymMerchantRole::find(session('role_id'));
        $this->data['permissions'] = GymMerchantPermission::whereFor('gyms')->get();
        $this->data['userPermissions'] = GymMerchantPermissionRole::rolePermissions($id);

        return view('gym-admin.super-admin.create-branches.permission', $this->data);
    }

    public function storePermissionPage(PermissionStoreRequest $request)
    {
        //region Permission Role
        $permissions = $request->permissions;
        $role = GymMerchantRole::find(session('role_id'));
        $role->perms()->sync($permissions);
        //endregion

        //region Assign Role
        $gymManagerRoleUser = GymMerchantRoleUser::firstorNew(['id' => session('role_id')]);
        $gymManagerRoleUser->user_id = session('manager_id');
        $gymManagerRoleUser->role_id = session('role_id');
        $gymManagerRoleUser->save();
        //endregion

        //region Super Admin Authority
        $gymMerchantRole = new GymMerchantRole();
        $gymMerchantRole->detail_id = session('branch_id');
        $gymMerchantRole->name = 'Super Admin';
        $gymMerchantRole->save();

        $permissions = GymMerchantPermission::all();
        $roles = $gymMerchantRole->id;

        $gymMerchantRoleUser = new GymMerchantRoleUser();
        $gymMerchantRoleUser->user_id = $this->data['user']->id;
        $gymMerchantRoleUser->role_id = $roles;
        $gymMerchantRoleUser->save();

        $role = GymMerchantRole::find($roles);
        $role->perms()->sync($permissions);

        $merchantAdminBusiness = new MerchantBusiness();
        $merchantAdminBusiness->detail_id = session('branch_id');
        $merchantAdminBusiness->merchant_id = $this->data['user']->id;
        $merchantAdminBusiness->save();
        //endregion

        return Reply::redirect(route('gym-admin.superadmin.complete'), 'Permissions are added successfully.');
    }

    public function completePage()
    {
        $this->data['title'] = "Manage Branches - Complete";

        //region forget previous stored session
        session()->forget('manager_id');
        session()->forget('branch_id');
        session()->forget('role_id');
        //endregion

        return view('gym-admin.super-admin.create-branches.complete', $this->data);
    }

    public function setBusinessId(Request $request)
    {
        session(['business_id' => $request->businessId]);

        return Reply::dataOnly(['success' => true]);
    }

    public function updateRolesAndPermissionPage(RoleAndPermissionUpdateRequest $request)
    {
        //region check role for particular manager exist
        $checkManagerRole = GymMerchantRoleUser::where('gym_merchant_role_users.user_id', '=', $request->manager_id)
            ->where('gym_merchant_role_users.role_id', '=', $request->role_id)
            ->count();

        if($checkManagerRole > 0) {
            return Reply::success('Role is already assigned to manager');
        }

        //endregion

        $businessAdminCheck = MerchantBusiness::join('merchants', 'merchants.id', '=', 'merchant_businesses.merchant_id')
            ->where('merchants.is_admin', '=', 1)
            ->where('merchant_businesses.detail_id', '=', $this->data['user']->detail_id)
            ->count();

        if($businessAdminCheck > 1) {

            $gymMerchantRoleUser = GymMerchantRoleUser::where('user_id', '=', $request->manager_id)
                ->first();
            $gymMerchantRoleUser->user_id = $request->manager_id;
            $gymMerchantRoleUser->role_id = $request->role_id;
            $gymMerchantRoleUser->save();

            $merchantAdmin = Merchant::find($request->manager_id);
            $merchantAdmin->is_admin = 0;
            $merchantAdmin->save();

            return Reply::redirect(route('gym-admin.superadmin.index'), 'Role is changed successfully.');

        } elseif($businessAdminCheck == 1) {

            $merchantAdminCheck = Merchant::find($request->manager_id);

            if($merchantAdminCheck->is_admin == 1) {

                return Reply::error('Make another Super Admin to change the role');

            } else {

                $gymMerchantRoleUser = GymMerchantRoleUser::where('user_id', '=', $request->manager_id)
                    ->first();
                
                if($gymMerchantRoleUser) {

                    $gymMerchantRoleUser->user_id = $request->manager_id;
                    $gymMerchantRoleUser->role_id = $request->role_id;
                    $gymMerchantRoleUser->save();

                } else {

                    $gymMerchantRoleUser = new GymMerchantRoleUser();
                    $gymMerchantRoleUser->user_id = $request->manager_id;
                    $gymMerchantRoleUser->role_id = $request->role_id;
                    $gymMerchantRoleUser->save();

                }

                $merchantAdminRoleCheck = GymMerchantRole::select('gym_merchant_roles.id', 'gym_merchant_roles.name')
                    ->join('gym_merchant_role_users', 'gym_merchant_role_users.role_id', '=', 'gym_merchant_roles.id')
                    ->join('merchants', 'merchants.id', '=', 'gym_merchant_role_users.user_id')
                    ->where('gym_merchant_roles.detail_id', '=', $this->data['user']->detail_id)
                    ->where('merchants.is_admin', '=', 1)
                    ->first();

                if($request->role_id == $merchantAdminRoleCheck->id) {
                    $merchantAdmin = Merchant::find($request->manager_id);
                    $merchantAdmin->is_admin = 1;
                    $merchantAdmin->save();
                }

                return Reply::redirect(route('gym-admin.superadmin.index'), 'Role is changed successfully.');
            }
        }
    }

    public function getEarningChartData(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $branch = $request->branch;
        $expenses = GymExpense::select(DB::raw('sum(price) as expense, MONTHNAME(purchase_date) as month, DATE_FORMAT(purchase_date, \'%y\') as year'))
            ->where(function($query) use ($month, $year, $branch) {
                if(isset($month)) {
                    $query->whereMonth('purchase_date', '=', $month);
                }

                if(isset($year)) {
                    $query->whereYear('purchase_date', '=', $year);
                }

                if(isset($branch)) {
                    $query->where('detail_id', '=', $branch);
                }
            })->groupBy('MONTH')
            ->orderByRaw('purchase_date DESC')
            ->get();

        $incomes = GymMembershipPayment::select(DB::raw('sum(payment_amount) as income, MONTHNAME(payment_date) as month, DATE_FORMAT(payment_date, \'%y\') as year'))
            ->where(function($query) use ($month, $year, $branch) {
                if(isset($month)) {
                    $query->whereMonth('payment_date', '=', $month);
                }

                if(isset($year)) {
                    $query->whereYear('payment_date', '=', $year);
                }

                if(isset($branch)) {
                    $query->where('detail_id', '=', $branch);
                }
            })->groupBy('MONTH')
            ->orderByRaw('payment_date DESC')
            ->get();
        $expenseArray = [];
        foreach ($expenses as $key => $expense) {
            $temp = [
                'month' => $expense->month.' '.$expense->year,
                'expense' => $expense->expense,
            ];
            array_push($expenseArray, $temp);
        }

        $incomeArray = [];
        foreach ($incomes as $income) {
            $temp = [
                'month' => $income->month.' '.$income->year,
                'income' => $income->income,
            ];
            array_push($incomeArray, $temp);
        }

        $data = array_replace_recursive($incomeArray, $expenseArray);
        $this->data['incomeExpenseChart'] = \GuzzleHttp\json_encode(array_reverse($data));

        return Reply::dataOnly(['information' => $this->data['incomeExpenseChart']]);
    }

    public function getClientChartData(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $branch = $request->branch;
        $clientRegisters = GymClient::select(DB::raw('count(joining_date) as client, MONTHNAME(joining_date) as month, DATE_FORMAT(joining_date, \'%y\') as year'))
            ->where(function($query) use ($month, $year, $branch) {
                if (isset($year)) {
                    $query->whereYear('joining_date', '=', $year);
                }

                if (isset($branch)) {
                    $query->where('detail_id', '=', $branch);
                }

                if(isset($month)) {
                    $query->whereMonth('joining_date', '=', $month);
                }

            })->groupBy('MONTH')
            ->orderByRaw('joining_date DESC')
            ->get();

        $clientInformation = [];
        if(count($clientRegisters) > 0) {
            foreach ($clientRegisters as $clientRegister) {
                $temp = [
                    'month' => $clientRegister->month.' '.$clientRegister->year,
                    'client' => $clientRegister->client,
                ];
                array_push($clientInformation, $temp);
            }
        }

        $this->data['clientRegisterChart'] = \GuzzleHttp\json_encode(array_reverse($clientInformation));

        return Reply::dataOnly(['information' => $this->data['clientRegisterChart']]);
    }
}
