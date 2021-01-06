<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Http\Requests\GymAdmin\GymExpense\StoreUpdateRequest;
use App\Models\GymExpense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Yajra\Datatables\Facades\Datatables;

class GymAdminExpenseManagementController extends GymAdminBaseController
{
    public function __construct() {
        parent::__construct();
        $this->data['paymentMenu'] = 'active';
        $this->data['expenseMenu'] = 'active';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!$this->data['user']->can("expense")) {
            return App::abort(401);
        }

        $this->data['title'] = 'GymExpense Manager';
        return View::make('gym-admin.expense.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->data['user']->can("expense")) {
            return App::abort(401);
        }

        $this->data['title'] = "GymExpense Create";
        return View::make('gym-admin.expense.create-edit', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRequest $request)
    {
        $gymExpense = new GymExpense();
        $gymExpense->detail_id = $this->data['user']->detail_id;
        $gymExpense->item_name = $request->item_name;
        $gymExpense->purchase_date = Carbon::createFromFormat('m/d/Y', $request->purchase_date)->format('Y-m-d');
        $gymExpense->purchase_from = $request->purchase_from;
        $gymExpense->price = $request->price;
        $gymExpense->save();

        if($request->hasFile('bill')) {
            $this->uploadBill($request->bill, $gymExpense->id);
        } else {
            $gymExpense->bill = $request->bill;
        }

        return Reply::redirect(route('gym-admin.expense.index'), "GymExpense created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$this->data['user']->can("expense")) {
            return App::abort(401);
        }

        $this->data['expense'] = GymExpense::find($id);
        $this->data['title'] = "GymExpense Update";
        return View::make('gym-admin.expense.create-edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRequest $request, $id)
    {
        $gymExpense = GymExpense::find($id);
        $gymExpense->detail_id = $this->data['user']->detail_id;
        $gymExpense->item_name = $request->item_name;
        $gymExpense->purchase_date = Carbon::createFromFormat('m/d/Y', $request->purchase_date)->format('Y-m-d');
        $gymExpense->purchase_from = $request->purchase_from;
        $gymExpense->price = $request->price;
        $gymExpense->save();

        if($request->hasFile('bill')) {
            $this->uploadBill($request->bill, $id);
        } else {
            $gymExpense->bill = $request->bill;
        }

        return Reply::redirect(route('gym-admin.expense.index'), "GymExpense updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$this->data['user']->can("expense")) {
            return App::abort(401);
        }

        $expense = GymExpense::find($id);
        $expense->delete();

        return Reply::redirect(route('gym-admin.expense.index'), "GymExpense removed successfully");
    }

    public function getExpense()
    {
        if (!$this->data['user']->can("expense")) {
            return App::abort(401);
        }

        $expense = GymExpense::select('id', 'item_name', 'purchase_date', 'price')
            ->where('detail_id', '=', $this->data['user']->detail_id);
        return Datatables::of($expense)->add_column('action', function ($row) {

            return '<div class="btn-group">
                    <button class="btn blue btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-gears"></i> <span class="hidden-xs">Actions</span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="' . route('gym-admin.expense.show', $row->id) . '"> <i class="fa fa-edit"></i>Show Expense</a>
                        </li>
                        <li>
                            <a href="javascript:;" onClick="deleteModal(' . $row->id . ')"> <i class="fa fa-trash"></i> Delete</a>
                        </li>
                    </ul>
                </div>';
        })->edit_column('purchase_date', function ($row) {
                return Carbon::createFromFormat('Y-m-d', $row->purchase_date)->toFormattedDateString();
        })->edit_column('price', function ($row) {
                return round($row->price, 2);
        })
            ->rawColumns([4])
            ->make();
    }

    public function removeExpense($id)
    {
        $this->data['expense'] = GymExpense::select('item_name', 'id')
            ->where('id', '=', $id)
            ->first();
        return View::make('gym-admin.expense.destroy', $this->data);
    }

    public function uploadBill($file, $id)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = $id . "-" . rand(10000, 99999) . "." . $extension;
        if($this->data['gymSettings']->local_storage == 1) {
            if(!file_exists(public_path()."/uploads/bill/")) {
                File::makeDirectory(public_path()."/uploads/bill/", $mode = 0777, true, true);
            }
            $destinationPath = public_path()."/uploads/bill/$filename";
            Image::make($file->getRealPath())->save($destinationPath);

        } else {
            $destinationPath = "/uploads/bill/$filename";
            $this->uploadImageS3($file, $destinationPath);
        }
        $gymExpense = GymExpense::find($id);
        $gymExpense->bill = $filename;
        $gymExpense->save();
    }

    public function uploadImageS3($imageMake, $filePath) {

        if (get_class($imageMake) === 'Intervention\Image\Image') {
            Storage::put($filePath, $imageMake->stream()->__toString(), 'public');
        } else {
            Storage::put($filePath, fopen($imageMake, 'r'), 'public');
        }

    }
}
