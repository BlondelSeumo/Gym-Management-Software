<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Models\MerchantPromotionDatabase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;

class GymPromotionalDbController extends GymAdminBaseController
{

    public function index() {

        if (!$this->data['user']->can("view_previous_promotions")) {
            return App::abort(401);
        }

        $this->data['title'] = "Promotional Database";
        return View::make('gym-admin.promotional-db.index', $this->data);
    }

    public function create() {
        $this->data['title'] = "Promotional Database";
        return View::make('gym-admin.promotional-db.create', $this->data);
    }

    public function ajax_create() {
        $db = MerchantPromotionDatabase::select('name', 'email', 'mobile', 'age', 'gender', 'id')
            ->where('detail_id', '=', $this->data['user']->detail_id);
        return Datatables::of($db)
            ->edit_column('name', function ($row) {
                return ucwords($row->name);
            })
            ->edit_column('email', function ($row) {
                return '<i class="fa fa-envelope"></i> ' . $row->email;
            })
            ->edit_column('mobile', function ($row) {
                return '<i class="fa fa-mobile"></i> ' . $row->mobile;
            })->edit_column('gender', function ($row) {
                if ($row->gender == 'female') {
                    return '<i class="fa fa-female"></i> Female';
                }
                else {
                    return '<i class="fa fa-male"></i> Male';
                }
            })
            ->add_column('action', function ($row) {
                return "<div class=\"btn-group\">
                    <button class=\"btn blue btn-xs dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\"><i class=\"fa fa-gears\"></i> <span class=\"hidden-xs\">Actions</span>
                        <i class=\"fa fa-angle-down\"></i>
                    </button>
                    <ul class=\"dropdown-menu pull-right\" role=\"menu\">
                        <li>
                            <a href='" . route('gym-admin.promotion-db.show', $row->id) . "'> <i class=\"fa fa-edit\"></i> Edit</a>
                        </li>
                        <li>
                            <a href=\"javascript:;\" class='remove-target' data-id=$row->id> <i class=\"fa fa-trash\"></i> Remove</a>
                        </li>
                    </ul>
                </div>";
            })->remove_column('id')
            ->rawColumns([1,2,4,5])
            ->make();
    }

    public function store() {
        $validator = Validator::make(Input::all(), MerchantPromotionDatabase::rules('add', null));

        if ($validator->fails()) {
            return Reply::formErrors($validator);
        }

        $data = [
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'number' => Input::get('mobile'),
            'age' => Input::get('age'),
            'gender' => Input::get('gender')
        ];

        $this->addPromotionDatabase($data);

        return Reply::redirect(route('gym-admin.promotion-db.index'), 'Client added to database');

    }

    public function update($id) {
        $validator = Validator::make(Input::all(), MerchantPromotionDatabase::rules('edit', $id));
//        $validator = Validator::make(Input::all(),MerchantPromotionDatabase::$rules);

        if ($validator->fails()) {
            return Reply::formErrors($validator);
        }

        $user = MerchantPromotionDatabase::where('id', '=', $id)->where('detail_id', '=', $this->data['user']->detail_id)->first();
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->age = Input::get('age');
        $user->mobile = Input::get('mobile');
        $user->gender = Input::get('gender');
        $user->save();

        return Reply::success('Client updated to database');
    }

    public function show($id) {
        $this->data['title'] = "Promotional Database";
        $this->data['client'] = MerchantPromotionDatabase::find($id);
        return View::make('gym-admin.promotional-db.edit', $this->data);
    }

    public function destroy($id) {
        if (request()->ajax()) {
            $promotional = MerchantPromotionDatabase::find($id);
            $promotional->delete();

            return Reply::success("promotional deleted successfully.");
        }
    }

}
