<?php

namespace App\Http\Controllers\GymAdmin;

use App\Helper\Reply;
use App\Models\MerchantCustomPaymentType;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Validator;
use Yajra\Datatables\Facades\Datatables;

class GymCustomPaymentTypeController extends GymAdminBaseController
{
    public function index()
    {
        $this->data['title'] = 'Custom Payment Type';
        return View::make('gym-admin.custom-type.index',$this->data);
    }

    public  function  ajax_create(){
        $types = MerchantCustomPaymentType::select('id','name')
            ->where('detail_id','=',$this->data['user']->detail_id);

        return Datatables::of($types)
            ->edit_column('name',function($row){
                return ucfirst($row->name);
            })->add_column('action',function($row){
                return '<div class="btn-group">
                    <button class="btn blue btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-gears"></i> <span class="hidden-xs">Actions</span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="javascript:;" class="editType" data-id="'.$row->id.'"> <i class="fa fa-edit"></i> Edit</a>
                        </li>
                        <li>
                            <a href="javascript:;" class="deleteType" data-id="'.$row->id.'"> <i class="fa fa-trash"></i> Remove</a>
                        </li>       
                    </ul>
                </div>';
            })->remove_column('id')->make();
    }
    
    public function create()
    {
        return View::make('gym-admin.custom-type.create');
    }

    public  function store()
    {
        $validator = Validator::make(Input::get(),['name'=>'required']);
        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }else{

            $type = new MerchantCustomPaymentType();
            $type->name = Input::get('name');
            $type->detail_id = $this->data['user']->detail_id;
            $type->save();
            return Reply::success('Type added successfully');
        }
    }
    
}
