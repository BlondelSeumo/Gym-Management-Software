<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Models\GymMerchantPermission;
use App\Models\GymMerchantPermissionRole;
use App\Models\GymMerchantRole;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class GymAdminManageRolesController extends GymAdminBaseController
{

    public function index() {
        if(!$this->data['user']->can("manage_permissions"))
        {
            return App::abort(401);
        }

        $this->data['title'] = 'Roles';
        return view('gym-admin.gymroles.index', $this->data);
    }

    public function ajaxCreate() {
        if(!$this->data['user']->can("manage_permissions"))
        {
            return App::abort(401);
        }

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

        } else {
            $result = GymMerchantRole::where('detail_id', $this->data['user']->detail_id)
                ->select('id', 'name');
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
                                <a href="' . route('gym-admin.gymmerchantroles.edit', $row->id) . '" > <i class="fa fa-edit"></i> Edit</a>
                            </li>
                            <li>
                                <a href="' . route('gym-admin.gymmerchantroles.assign-permission', $row->id) . '" data-role-id="'.$row->id.'" class="assign-permissions"> <i class="fa fa-pencil"></i> Assign Permissions</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-role-id="'.$row->id.'" class="remove-role"> <i class="fa fa-trash"></i> Remove</a>
                            </li>
                        </ul>
                    </div>';
            }
            )
            ->removeColumn('id')
            ->rawColumns([1])
            ->make();
    }

    public function create() {
        if(!$this->data['user']->can("manage_permissions"))
        {
            return App::abort(401);
        }

        $this->data['title'] = 'Add Role';
        return view('gym-admin.gymroles.create', $this->data);
    }

    public function store(Request $request) {
        if(!$this->data['user']->can("manage_permissions"))
        {
            return App::abort(401);
        }

        $validator = Validator::make($request->all(), GymMerchantRole::$rules);

        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }

        $role = new GymMerchantRole();
        $role->name = $request->input('name');
        $role->detail_id = $this->data['user']->detail_id;

        $role->save();


        return Reply::redirect(route('gym-admin.gymmerchantroles.index'), 'New role added.');
    }

    public function edit($id) {
        if(!$this->data['user']->can("manage_permissions"))
        {
            return App::abort(401);
        }

        $this->data['title'] = 'Edit Role';
        $this->data['role'] = GymMerchantRole::where('detail_id', $this->data['user']->detail_id)->find($id);
        return view('gym-admin.gymroles.edit', $this->data);
    }

    public function update($id, Request $request) {
        if(!$this->data['user']->can("manage_permissions"))
        {
            return App::abort(401);
        }

        $validator = Validator::make($request->all(), GymMerchantRole::$rules);

        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }

        $role = GymMerchantRole::find($id);
        $role->name = $request->input('name');
        $role->detail_id = $this->data['user']->detail_id;
        $role->save();


        return Reply::redirect(route('gym-admin.gymmerchantroles.index'), 'Role updated.');
    }

    public function destroy($id) {
        if(!$this->data['user']->can("manage_permissions"))
        {
            return App::abort(401);
        }
        $role = GymMerchantRole::find($id);
        $role->delete();

        return Reply::redirect(route('gym-admin.gymmerchantroles.index'), 'Role removed successfully');

    }

    public function assignPermission($id) {
        if(!$this->data['user']->can("manage_permissions"))
        {
            return App::abort(401);
        }

        $this->data['title'] = 'Assign Permission';

        $this->data['role'] = GymMerchantRole::find($id);

        $this->data['permissions'] = GymMerchantPermissionRole::rolePermissions($id);

        $this->data['permissions_all'] = GymMerchantPermission::whereFor('gyms')->get();

        return view('gym-admin.gymroles.assign_permission', $this->data);
    }

    public function assignPermissionStore($id, Request $request) {
        if(!$this->data['user']->can("manage_permissions"))
        {
            return App::abort(401);
        }

        $permissions = $request->input('permissions');

        $role = GymMerchantRole::find($id);

        $role->perms()->sync($permissions);

        return Reply::redirect(route('gym-admin.gymmerchantroles.index'), 'Permissions updated.');
    }

}
