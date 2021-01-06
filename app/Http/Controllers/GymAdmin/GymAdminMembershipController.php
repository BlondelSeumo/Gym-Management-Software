<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Models\BusinessCategory;
use App\Models\Category;
use App\Models\GymMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class GymAdminMembershipController extends GymAdminBaseController
{

    public function __construct() {
        parent::__construct();
        $this->data['manageMenu'] = 'active';
        $this->data['membershipMenu'] = 'active';
    }

    public function index() {
        if(!$this->data['user']->can("view_membership"))
        {
            return App::abort(401);
        }

        $this->data['membershipindexMenu'] = 'active';
        $this->data['title'] = "All Membership";

        $this->data['subcategories'] = BusinessCategory::businessCategories($this->data['user']->detail_id);
//        echo"<pre>";
//        print_r($this->data['subcategories']);die;
        return view('gym-admin.membership.index', $this->data);
    }

    public function create() {
        if(!$this->data['user']->can("add_membership"))
        {
            return App::abort(401);
        }

        $this->data['membershipindexMenu'] = '';
        $this->data['membershipcreateMenu'] = 'active';
        $this->data['title'] = "Add Membership";

        $this->data['subcategories'] = BusinessCategory::businessCategories($this->data['user']->detail_id);

        return view('gym-admin.membership.create', $this->data);
    }

    public function store(Request $request) {
        if(!$this->data['user']->can("add_membership"))
        {
            return App::abort(401);
        }

        $validator = Validator::make($request->all(), GymMembership::rules('add', $request->get('business_sub_category_id')));

        $validator->sometimes('next_payment_date', 'required', function($input) {
            return $input->payment_required == 'yes';
        });

        if($validator->fails()) {
            return Reply::formErrors($validator);
        }
        else{
            $category = BusinessCategory::first();
            $inputData = $request->all();
            $inputData['detail_id'] = $this->data['user']->detail_id;
            $inputData['business_category_id'] = $category->id;
            $inputData['status'] = 'active';
//            unset($inputData['business_sub_category_id']);
            GymMembership::create($inputData);

            return Reply::redirect(route('gym-admin.membership.index'),'Membership added successfully.');
        }
    }

    public function edit($id) {
        if(!$this->data['user']->can("edit_membership"))
        {
            return App::abort(401);
        }

        $this->data['title'] = "Edit Membership";

        $this->data['subcategories'] = BusinessCategory::businessCategories($this->data['user']->detail_id);
        $this->data['membership'] = GymMembership::merchantMembershipDetail($id, $this->data['user']->detail_id);

        return view('gym-admin.membership.edit', $this->data);
    }

    public function update(Request $request, $id) {
        if(!$this->data['user']->can("edit_membership"))
        {
            return App::abort(401);
        }

        $validator = Validator::make($request->all(), GymMembership::rules('edit', $request->get('business_sub_category_id'), $id));

        if($validator->fails()) {
            return Reply::formErrors($validator);
        }
        else{
            $category = BusinessCategory::first();
            $inputData = $request->all();
            $membership = GymMembership::find($id);
            $membership->title = $inputData['title'];
            $membership->price = $inputData['price'];
            $membership->duration = $inputData['duration'];
            $membership->business_category_id = $category->id;
            $membership->details = $inputData['details'];

            $membership->save();

            return Reply::redirect(route('gym-admin.membership.index'),'Membership added successfully.');
        }
    }

    public function destroy($id) {
        if(!$this->data['user']->can("delete_membership"))
        {
            return App::abort(401);
        }

        if(request()->ajax()){

            GymMembership::destroy($id);

            return Reply::success("Membership deleted successfully.");
        }
    }

}
