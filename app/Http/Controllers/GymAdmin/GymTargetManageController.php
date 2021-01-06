<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Http\Requests\GymAdmin\Targets\StoreUpdateRequest;
use App\Models\GymMembershipPayment;
use App\Models\GymPurchase;
use App\Models\SetTarget;
use App\Models\TargetType;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;

class GymTargetManageController extends GymAdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['manageMenu'] = 'active';
        $this->data['targetMenu'] = 'active';
    }

    public function index()
    {
        if(!$this->data['user']->can("view_targets"))
        {
            return App::abort(401);
        }

        $this->data['title'] = 'Targets';
        $targets = SetTarget::where('detail_id','=',$this->data['user']->detail_id)->get();
        $targetCount = 0;
        $targetCompleted = 0;
        $targetStats = array();
        foreach ($targets as $key => $target)
        {
            ++$targetCount;
            if($target->targetType->type == 'membership'){

                $date = Carbon::createFromFormat('Y-m-d',$target->date);
                $start_date = Carbon::createFromFormat('Y-m-d',$target->start_date);

                $users = GymPurchase::whereBetween('purchase_date',[$start_date->format('Y-m-d'),$date->format('Y-m-d')])
                    ->where('detail_id','=',$this->data['user']->detail_id)->count();

                $target_achieve_percent  =  ($users/$target->value)*100;
                $targetStats[$key]['name'] = $target->title;
                $targetStats[$key]['percent'] = ($target_achieve_percent > 100) ? 100 : $target_achieve_percent;
                if($target_achieve_percent>=100)
                {
                    ++$targetCompleted;
                }

            }
            if($target->targetType->type == 'revenue')
            {
                $date = Carbon::createFromFormat('Y-m-d',$target->date);
                $start_date = Carbon::createFromFormat('Y-m-d',$target->start_date);

                $sales = GymMembershipPayment::leftJoin('gym_client_purchases','gym_client_purchases.id','=','purchase_id')
                    ->whereBetween('payment_date',[$start_date->format('Y-m-d'),$date->format('Y-m-d')])
                    ->where('gym_client_purchases.detail_id','=',$this->data['user']->detail_id)->sum('payment_amount');

                $target_achieve_percent  =  ($sales/$target->value)*100;
                $targetStats[$key]['name'] = $target->title;
                $targetStats[$key]['percent'] = ($target_achieve_percent > 100) ? 100 : $target_achieve_percent;
                if($target_achieve_percent>=100)
                {
                    ++$targetCompleted;
                }
            }
        }

        $this->data['allCount'] = $targetCount;
        $this->data['allCompleted'] = $targetCompleted;
        $this->data['targetsProgress'] = $targetStats;

        return View::make('gym-admin.target.index',$this->data);
    }

    public function ajax_create()
    {
        if(!$this->data['user']->can("view_targets"))
        {
            return App::abort(401);
        }

        $target = SetTarget::select('set_targets.title','target_type.type as target_value','set_targets.value','date','set_targets.id')
            ->leftJoin('target_type','target_type.id','=','set_targets.target_type')
            ->where('set_targets.detail_id','=',$this->data['user']->detail_id);

        return Datatables::of($target)
            ->edit_column('date',function($row){
                return Carbon::createFromFormat('Y-m-d',$row->date)->format('jS F');
            })
            ->add_column('action',function($row){
                return'<div class="btn-group">
                    <button class="btn blue btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-gears"></i> <span class="hidden-xs">Actions</span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="'.route('gym-admin.target.show',$row->id).'"> <i class="fa fa-edit"></i> Edit </a>
                        </li>
                        <li>
                            <a href="javascript:;" data-id="'.$row->id.'" class="remove-target"> <i class="fa fa-trash"></i>Remove </a>
                        </li>
                    </ul>
                </div>';
            })
            ->remove_column('id')
            ->rawColumns([4])
            ->make();
    }

    public function create()
    {
        if(!$this->data['user']->can("add_target"))
        {
            return App::abort(401);
        }

        $this->data['target_type'] =TargetType::targetType($this->data['user']->detail_id);
        $this->data['title'] = 'Add Target';
        return View::make('gym-admin.target.create',$this->data);
    }

    public function store(StoreUpdateRequest $request)
    {
        if(!$this->data['user']->can("add_target"))
        {
            return App::abort(401);
        }

        $target = new SetTarget();
        $target->target_type    = $request->get('target_type');
        $target->title          = $request->get('title');
        $target->value          = $request->get('value');
        $target->detail_id      = $this->data['user']->detail_id;
        $target->date           = Carbon::createFromFormat('m/d/Y', $request->get('date'))->format('Y-m-d');
        $target->start_date     = Carbon::createFromFormat('m/d/Y', $request->get('start_date'))->format('Y-m-d');
        $target->save();

        return Reply::redirect(route('gym-admin.target.index'),'Target added successfully');
    }

    public function show($id)
    {
        if(!$this->data['user']->can("edit_target"))
        {
            return App::abort(401);
        }

        $this->data['target_type']  =   TargetType::targetType($this->data['user']->detail_id);
        $this->data['target']       =   SetTarget::find($id);
        $this->data['title']        =   'Edit Target';
        return View::make('gym-admin.target.edit',$this->data);
    }

    public function update(StoreUpdateRequest $request, $id)
    {
        if(!$this->data['user']->can("edit_target"))
        {
            return App::abort(401);
        }

        $target = SetTarget::find($id);
        $target->target_type    = $request->get('target_type');
        $target->title          = $request->get('title');
        $target->value          = $request->get('value');
        $target->detail_id      = $this->data['user']->detail_id;
        $target->date           = Carbon::createFromFormat('m/d/Y', $request->get('date'))->format('Y-m-d');
        $target->start_date     = Carbon::createFromFormat('m/d/Y', $request->get('start_date'))->format('Y-m-d');
        $target->save();

        return Reply::redirect(route('gym-admin.target.index'),'Target added successfully');
    }

    public function destroy($id,Request $request)
    {
        if(!$this->data['user']->can("delete_target"))
        {
            return App::abort(401);
        }

        if($request->ajax())
        {
            SetTarget::destroy($id);
            return Reply::success('Target removed successfully');
        }
        return Reply::error('Request not Valid');
    }

}
