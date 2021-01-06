<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Models\GymMerchantRole;
use App\Models\GymMerchantRoleUser;
use App\Models\Merchant;
use App\Models\MerchantBusiness;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class GymAdminManageUsersController extends GymAdminBaseController
{

    public function index() {
        if(!$this->data['user']->can("manage_permissions"))
        {
            return App::abort(401);
        }

        $this->data['title'] = 'Users List';
        $this->data['userCount'] = Merchant::leftJoin('merchant_businesses', 'merchant_businesses.merchant_id', '=', 'merchants.id')
                    ->leftJoin('gym_merchant_role_users', 'gym_merchant_role_users.user_id', '=', 'merchants.id')
                    ->leftJoin('gym_merchant_roles', 'gym_merchant_roles.id', '=', 'gym_merchant_role_users.role_id')
                    ->where('merchant_businesses.detail_id', $this->data['user']->detail_id)
                    ->select('merchants.id', 'merchants.username', 'gym_merchant_roles.name')
                    ->count();

        return view('gym-admin.users.index', $this->data);
    }

    public function create() {
        if(!$this->data['user']->can("manage_permissions"))
        {
            return App::abort(401);
        }

        $this->data['title'] = 'Add User';
        return view('gym-admin.users.create', $this->data);
    }

    public function ajaxCreate() {
        if(!$this->data['user']->can("manage_permissions"))
        {
            return App::abort(401);
        }

        if($this->data['user']->is_admin == 0) {
            $result = Merchant::leftJoin('merchant_businesses', 'merchant_businesses.merchant_id', '=', 'merchants.id')
                ->leftJoin('gym_merchant_role_users', 'gym_merchant_role_users.user_id', '=', 'merchants.id')
                ->leftJoin('gym_merchant_roles', 'gym_merchant_roles.id', '=', 'gym_merchant_role_users.role_id')
                ->where('merchant_businesses.detail_id', $this->data['user']->detail_id)
                ->where('merchants.is_admin', '!=', 1)
                ->select('merchants.id', 'merchants.username', 'gym_merchant_roles.name');
        } else {
            $result = Merchant::leftJoin('merchant_businesses', 'merchant_businesses.merchant_id', '=', 'merchants.id')
                ->leftJoin('gym_merchant_role_users', 'gym_merchant_role_users.user_id', '=', 'merchants.id')
                ->leftJoin('gym_merchant_roles', 'gym_merchant_roles.id', '=', 'gym_merchant_role_users.role_id')
                ->where('merchant_businesses.detail_id', $this->data['user']->detail_id)
                ->groupBy('merchants.username')
                ->select('merchants.id', 'merchants.username', 'gym_merchant_roles.name');
        }

        return Datatables::of($result)
            ->add_column(
                'edit', function($row) {
                    return '<div class="btn-group">
                        <button class="btn blue btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-gears"></i> <span class="hidden-xs">Action</span>
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="' . route('gym-admin.users.edit', $row->id) . '" > <i class="fa fa-edit"></i> Edit</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-user-id="'.$row->id.'" class="assign-role"> <i class="fa fa-pencil"></i> Assign Role</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-user-id="'.$row->id.'" class="remove-user"> <i class="fa fa-trash"></i> Delete User</a>
                            </li>
                        </ul>
                    </div>';
                }
            )
            ->removeColumn('id')
            ->rawColumns([2])
            ->make();
    }

    public function edit($id) {
        if(!$this->data['user']->can("manage_permissions"))
        {
            return App::abort(401);
        }

        $this->data['title'] = 'User Edit';
        $this->data['merchant'] = Merchant::merchantDetail($this->data['user']->detail_id, $id);
        return view('gym-admin.users.edit', $this->data);
    }

    public function store() {

        if(!$this->data['user']->can("manage_permissions"))
        {
            return App::abort(401);
        }

        $validator = Validator::make(Input::all(), Merchant::$addUserRules);

        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }

        $profile = new Merchant();
        $profile->first_name = Input::get('first_name');
        $profile->last_name = Input::get('last_name');
        $profile->mobile = Input::get('mobile');
        $profile->email = Input::get('email');
        $profile->gender = Input::get('gender');
        $profile->username = Input::get('username');
        $profile->gender = Input::get('gender');

        if(Input::get('date_of_birth') != '') {
            $profile->date_of_birth = Input::get('date_of_birth');
        }

        if(Input::has('password')) {
            $profile->password = Hash::make(Input::get('password'));
        }

        $profile->save();

        $insert = [
            "merchant_id" => $profile->id,
            "detail_id" => $this->data['user']->detail_id
        ];

        MerchantBusiness::firstOrCreate($insert);

        return Reply::redirect(route('gym-admin.users.index'), 'New user added.');
    }

    public function update($id) {
        $validator = Validator::make(Input::all(), Merchant::updateRules($id));

        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }

        $id = Input::get('id');
        $profile = Merchant::find($id);
        $profile->first_name = Input::get('first_name');
        $profile->last_name = Input::get('last_name');
        $profile->mobile = Input::get('mobile');
        $profile->email = Input::get('email');
        $profile->gender = Input::get('gender');
        $profile->username = Input::get('username');

        if(Input::get('date_of_birth') != '') {
            $profile->date_of_birth = Input::get('date_of_birth');
        }

        if(Input::has('password')) {
            $profile->password = Hash::make(Input::get('password'));
        }

        $profile->save();
        return Reply::success('User details updated.');
    }

    public function destroy($id, Request $request) {
        if(!$this->data['user']->can("manage_permissions"))
        {
            return App::abort(401);
        }

        if ($request->ajax()) {
            Merchant::find($id)->delete();
            return Reply::redirect(route('gym-admin.users.index'), 'User removed successfully');
        }

        return Reply::error('Request not Valid');
    }

    public function assignRoleModal($id) {
        if($this->data['user']->is_admin == 0) {
            $rolesResults = GymMerchantRole::where('detail_id', $this->data['user']->detail_id)
                ->select('id', 'name')
                ->get();

            $adminResult = GymMerchantRole::select('gym_merchant_roles.id', 'gym_merchant_roles.name')
                ->join('gym_merchant_role_users', 'gym_merchant_role_users.role_id', '=', 'gym_merchant_roles.id')
                ->join('merchants', 'merchants.id', '=', 'gym_merchant_role_users.user_id')
                ->where('gym_merchant_roles.detail_id', '=', $this->data['user']->detail_id)
                ->where('merchants.is_admin', '=', 1)
                ->first();

            $result = [];

            foreach ($rolesResults as $rolesResult) {
                if($adminResult->name != $rolesResult->name){
                    array_push($result, $rolesResult);
                }
            }

            $this->data['roles'] = $result;
        } else {
            $this->data['roles'] = GymMerchantRole::byBusinessId($this->data['user']->detail_id);
        }

        $this->data['user'] = Merchant::find($id);

        return view('gym-admin.users.assign_role_modal', $this->data);
    }

    public function assignRoleStore($id) {

        $this->data['title'] = "Assign Role";
        $this->data['roleSelected'] = "active open";

        $input = Input::all();

        $validator = Validator::make($input, GymMerchantRoleUser::$rules);

        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }

        GymMerchantRoleUser::where('user_id', '=', $id)->delete();

        GymMerchantRoleUser::create(['role_id' => $input['role_id'], 'user_id' => $id]);

        return Reply::redirect(route('gym-admin.users.index'), 'Role assigned.');
    }

}
