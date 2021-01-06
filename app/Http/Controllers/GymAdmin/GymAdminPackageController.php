<?php

namespace App\Http\Controllers\GymAdmin;

use App\Helper\Reply;
use App\Models\GymPackage;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class GymAdminPackageController extends GymAdminBaseController
{
    public function index()
    {
        $this->data['title'] = "All Packages";

        $this->data['packages'] = GymPackage::businessPackages($this->data['user']->detail_id);

        return view('gym-admin.package.index',$this->data);
    }

    public function create()
    {
        $this->data['title'] = "Add Packages";

        return view('gym-admin.package.create',$this->data);
    }

    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(),GymPackage::rules('add'));
        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }else{
            $inputData = $request->all();

            $inputData['detail_id'] = $this->data['user']->detail_id;
            $inputData['status'] = 'active';

            GymPackage::create($inputData);

            return Reply::success("Package added successfully.");
        }
    }

    public function edit($id)
    {
        $this->data['title'] = "Edit Membership";

        $this->data['package'] = GymPackage::businessPackageDetail($this->data['user']->detail_id,$id);

        return view('gym-admin.package.edit',$this->data);
    }

    public function update(Request $request,$id)
    {
        $validator =  Validator::make($request->all(),GymPackage::rules('add'));
        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }else{
            $inputData = $request->all();

            $package = GymPackage::find($id);
            $package->title = $inputData['title'];
            $package->price = $inputData['price'];
            $package->details = $inputData['details'];
            $package->package_for = $inputData['package_for'];
            $package->save();

            return Reply::success("Package updated successfully.");
        }
    }

    public function destroy($id)
    {
        if(request()->ajax()){
            $package = GymPackage::businessPackageDetail($this->data['user']->detail_id,$id);
            $package->delete();

            return Reply::success("Package deleted successfully.");
        }
    }

///////////////
}
