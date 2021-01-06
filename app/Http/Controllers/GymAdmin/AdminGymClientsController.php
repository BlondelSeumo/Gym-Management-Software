<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;


use App\Http\Requests\GymAdmin\GymAccountSetup\ClientStoreRequest;
use App\Http\Requests\GymAdmin\GymClient\UpdateClientRequest;
use App\Http\Requests\GymAdmin\Image\ImageRequest;
use App\Mail\CredentialMail;
use App\Models\BusinessCustomer;
use App\Models\GymClient;
use App\Models\GymClientAttendance;
use App\Models\GymEnquiries;
use App\Models\GymMembership;
use App\Models\GymMembershipPayment;
use App\Models\GymPurchase;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;
use Intervention\Image\Facades\Image;


class AdminGymClientsController extends GymAdminBaseController
{

    public function __construct() {
        parent::__construct();
        $this->data['manageMenu'] = 'active';
        $this->data['customerMenu'] = 'active';
    }

    public function index() {
        if (!$this->data['user']->can("view_customers")) {
            return App::abort(401);
        }

        $this->data['title'] = "Clients";
        return View::make('gym-admin.gymclients.index', $this->data);
    }

    public function ajax_create() {

        if (!$this->data['user']->can("view_customers")) {
            return App::abort(401);
        }

        $gym_clients = GymClient::join('business_customers', 'business_customers.customer_id', '=', 'gym_clients.id')
            ->where('business_customers.detail_id', '=', $this->data['merchantBusiness']->detail_id)
            ->select('gym_clients.id', 'gym_clients.first_name', 'gym_clients.last_name', 'gym_clients.dob', 'gym_clients.email', 'gym_clients.mobile', 'gym_clients.joining_date', 'gym_clients.image');

        return Datatables::of($gym_clients)->add_column('action', function ($row) {

            return '<div class="btn-group">
                    <button class="btn blue btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-gears"></i> <span class="hidden-xs">Actions</span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="' . route('gym-admin.client.show', $row->id) . '"> <i class="fa fa-edit"></i>Show Profile</a>
                        </li>
                        <li>
                            <a href="' . route('gym-admin.client-purchase.user-create', $row->id) . '"> <i class="fa fa-plus"></i>Add Subscription</a>
                        </li>
                        <li>
                            <a href="javascript:;" onClick="deleteModal(' . $row->id . ')"> <i class="fa fa-trash"></i> Delete</a>
                        </li>
                        <li>
                            <a href="' . route('gym-admin.client.calender', $row->id) . '" > <i class="fa fa-calendar"></i> View Attendance</a>
                        </li>
                    </ul>
                </div>';
        }, 8)->edit_column('first_name', function ($row) {
            if ($row->image != '') {
                if($this->data['gymSettings']->local_storage == '0')
                    return '<img style="width:50px;height:50px;" class="img-circle" src="'.$this->data['profileHeaderPath'].$row->image.'" alt="" />'. ucwords($row->first_name . ' ' . $row->last_name);
                else
                    return '<img style="width:50px;height:50px;" class="img-circle" src="'.asset('/uploads/profile_pic/master/').'/'.$row->image.'" alt="" />'. ucwords($row->first_name . ' ' . $row->last_name);
            }
            else {
                return '<img src="'.asset('/fitsigma/images/').'/'.'user.svg" style="width:50px;height:50px;" class="img-circle" /> ' . ucwords($row->first_name . ' ' . $row->last_name);
            }

        })
            ->edit_column('dob', function ($row) {
                if(!is_null($row->dob)) {
                    return $row->dob->toFormattedDateString();
                }
            })
            ->edit_column('mobile', function ($row) {
                return '<a href="tel:' . $row->mobile . '">' . $row->mobile . '</a>';
            })
            ->edit_column('joining_date', function ($row) {
                if (!is_null($row->joining_date))
                    return $row->joining_date->toFormattedDateString();
            })
            ->remove_column('id')
            ->remove_column('last_name')
            ->remove_column('image')
            ->rawColumns([0,3,5])
            ->make();
    }

    public function create() {
        if (!$this->data['user']->can("add_customers")) {
            return App::abort(401);
        }

        $this->data['title'] = "Clients Create";
        return View::make('gym-admin.gymclients.create', $this->data);
    }

    public function store(ClientStoreRequest $request) {
        if (!$this->data['user']->can("add_customers")) {
            return App::abort(401);
        }
        $gymClient = new GymClient();

        $gymClient->first_name = $request->get('first_name');
        $gymClient->last_name = $request->get('last_name');

        if ($request->get('dob') != '') {
            $gymClient->dob = Carbon::createFromFormat('m/d/Y', $request->get('dob'))->format('Y-m-d');
        }

        if ($request->get('marital_status') == 'yes' && $request->get('anniversary') != '') {
            $gymClient->anniversary = Carbon::createFromFormat('m/d/Y', $request->get('anniversary'))->format('Y-m-d');
        }

        $gymClient->gender = $request->get('gender');
        $gymClient->email = $request->get('email');
        $gymClient->mobile = $request->get('mobile');
        $gymClient->weight = $request->get('weight');
        $gymClient->height_inches = $request->get('height_inches');
        $gymClient->height_feet = $request->get('height_feet');
        $gymClient->password = Hash::make('123456');
        $address = $request->get('address');

        if($address === NULL) {
            $gymClient->address = '';
        } else {
            $gymClient->address = $address;
        }

        $gymClient->marital_status = $request->get('marital_status');

        $gymClient->image = "";

        $gymClient->save();

        $businessCustomer = new BusinessCustomer();
        $businessCustomer->detail_id = $this->data['merchantBusiness']->detail_id;
        $businessCustomer->customer_id = $gymClient->id;
        $businessCustomer->save();

        $data = [
            'name' => $gymClient->first_name . ' ' . $gymClient->last_name,
            'email' => $gymClient->email,
            'number' => $gymClient->mobile,
            'age'   => ($request->get('dob') != '')? Carbon::createFromFormat('m/d/Y', $request->get('dob'))->diff(Carbon::now())->format('%y'): null,
            'gender' => $gymClient->gender
        ];

        $this->addPromotionDatabase($data);

        $email = $request->get('email');

        $eText = 'Your account is active on Fitsigma Customer Panel use the following credentials to access your account.<br>Email: '.$email.'<br>Password: 123456';

        $this->data['title'] = "Welcome to Fitsigma Customer Panel";
        $this->data['mailHeading'] = "Customer Created";
        $this->data['emailText'] = $eText;
        $this->data['url'] = '';

        Mail::to($email)->send(new CredentialMail($this->data));

        return Reply::redirect(route('gym-admin.client.index'), "Client information added successfully");
    }

    public function show($id) {
        if (!$this->data['user']->can("edit_customers")) {
            return App::abort(401);
        }

        $client = GymClient::join('business_customers', 'business_customers.customer_id', '=', 'gym_clients.id')
            ->where('business_customers.detail_id', $this->data['user']->detail_id)
            ->find($id);
        $this->data['client'] = $client;
        $this->data['age'] = (!is_null($client->dob))? $client->dob->diff(Carbon::now())->format('%y'):'-';
        $this->data['title'] = "Clients Update";
        $purchases = GymPurchase::where('client_id', '=', $id)->where('detail_id', '=', $this->data['user']->detail_id)->get();
        $memberships = [];
        $start_dates = [];

        foreach ($purchases as $purchase) {
            if ($purchase->membership_id != null) {
                array_push($memberships, $purchase->membership_id);
                array_push($start_dates, $purchase->start_date->toFormattedDateString());
            }
        }

        $this->data['memberships'] = GymMembership::select('gym_memberships.id as id', 'categories.name', 'gym_memberships.title', 'gym_memberships.price', 'gym_memberships.status')
            ->leftJoin('business_categories', 'business_categories.id', '=', 'gym_memberships.business_category_id')
            ->leftJoin('categories', 'categories.id', '=', 'business_categories.category_id')
            ->whereIn('gym_memberships.id', $memberships)
            ->get()->toArray();

        foreach ($this->data['memberships'] as $key => $membership) {
            $this->data['memberships'][$key]['start_date'] = $start_dates[$key];
        }

        return View::make('gym-admin.gymclients.edit', $this->data);
    }

    public function update(UpdateClientRequest $request) {
        if (!$this->data['user']->can("edit_customers")) {
            return App::abort(401);
        }

        $id = $request->get('id');

        if ($request->get('type') == 'general') {
            $gym_client = GymClient::find($id);
            $gym_client->first_name = $request->get('first_name');
            $gym_client->last_name = $request->get('last_name');
            $gym_client->marital_status = $request->get('marital_status');

            if($request->get('password')) {
                $gym_client->password = Hash::make($request->get('password'));
            }

            if($request->get('dob') != '') {
                $gym_client->dob = Carbon::createFromFormat('m/d/Y', $request->get('dob'))->format('Y-m-d');
            }

            if ($request->get('marital_status') == 'yes' && $request->get('anniversary') != '') {
                $gym_client->anniversary = Carbon::createFromFormat('m/d/Y', trim($request->get('anniversary')))->format('Y-m-d');
            }

            $gym_client->gender = $request->get('gender');
            $gym_client->email = $request->get('email');
            $gym_client->mobile = $request->get('mobile');
            $gym_client->weight = $request->get('weight');
            $gym_client->client_source = $request->get('source');
            $gym_client->height_inches = $request->get('height_inches');
            $gym_client->height_feet = $request->get('height_feet');
            $gym_client->address = $request->get('address');
            $gym_client->save();

            return Reply::redirect(route('gym-admin.client.show', $id), "Clients personal information uploaded successfully");
        }
        if (Input::get('type') == 'other') {
            $gym_client = GymClient::find($id);

            $gym_client->save();
            return Reply::redirect(route('gym-admin.client.show', $id), "Clients other information uploaded successfully");
        }
        if (Input::get('type') == 'file') {

            return Reply::redirect(route('gym-admin.client.show', $id), "Clients Image uploaded successfully");
        }
        return Reply::error("Invalid request");
    }

    public function removeClient($id) {
        if (!$this->data['user']->can("delete_customers")) {
            return App::abort(401);
        }

        $this->data['client'] = GymClient::select('first_name', 'last_name', 'id')->where('id', '=', $id)->first();
        return View::make('gym-admin.gymclients.destroy', $this->data);
    }

    public function destroy($id) {
        if (!$this->data['user']->can("delete_customers")) {
            return App::abort(401);
        }

        $client = GymClient::find($id);
        $client->delete();

        return Reply::redirect(route('gym-admin.client.index'), "Clients Removed successfully");
    }

    public function calender($id) {
        if (!$this->data['user']->can("view_customer_attendance")) {
            return App::abort(401);
        }

        $this->data['title'] = "Calender";
        $this->data['attendance'] = GymClientAttendance::where('client_id', '=', $id)->get();
        $this->data['client'] = GymClient::find($id);
        return View::make('gym-admin.gymclients.calendar', $this->data);
    }

    public function ajax_create_payments($id) {
        if (!$this->data['user']->can("edit_customers")) {
            return App::abort(401);
        }

        $payments = GymMembershipPayment::select('gym_membership_payments.id as pid', 'payment_amount', 'gym_memberships.title as membership', 'payment_source', 'payment_date', 'payment_id')
            ->leftJoin('gym_client_purchases', 'gym_client_purchases.id', '=', 'gym_membership_payments.purchase_id')
            ->leftJoin('gym_clients', 'gym_clients.id', '=', 'gym_membership_payments.user_id')
            ->leftJoin('gym_memberships', 'gym_memberships.id', '=', 'gym_client_purchases.membership_id')
            ->where('gym_membership_payments.user_id', '=', $id)
            ->where('gym_memberships.detail_id', '=', $this->data['user']->detail_id);


        return Datatables::of($payments)->edit_column('payment_source', function ($row) {
            if ($row->payment_source == 'cash') {
                return "<div class='font-dark'> Cash <i class='fa fa-money'></i> </div>";
            }
            if ($row->payment_source == 'credit_card') {
                return "<div class='font-dark'> Credit Card <i class='fa fa-credit-card'></i> </div>";
            }
            if ($row->payment_source == 'debit_card') {
                return "<div class='font-dark'> Debit Card <i class='fa fa-cc-visa'></i> </div>  ";
            }
            else {
                return "<div class='font-dark'> Net Banking <i class='fa fa-internet-explorer '></i> </div>";
            }
        })->edit_column('payment_date', function ($row) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $row->payment_date)->toFormattedDateString();
        })->edit_column('payment_amount', function ($row) {
            return '<i class="fa '.$this->data['gymSettings']->currency->symbol.'"></i>' . $row->payment_amount;
        })->edit_column('membership', function ($row) {
            return ucwords($row->membership) . '<br> <span class="label label-info"> MEMBERSHIP </span>';
        })->edit_column('payment_id', function ($row) {
            return '<b>' . $row->payment_id . '</b>';
        })->add_column('action', function ($row) {
            return '<div class="btn-group">
                    <button class="btn green btn-xs dropdown-toggle" type="button" data-toggle="dropdown"> <span class="hidden-xs">Actions</span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right " role="menu">
                        <li>
                            <a href="' . route('gym-admin.membership-payment.show', $row->pid) . '"><i class="fa fa-edit"></i> Edit </a>
                        </li>

                        <li>
                            <a href="javascript:;" data-payment-id="' . $row->pid . '" class="remove-payment"> <i class="fa fa-trash"></i> Remove</a>
                        </li>
                    </ul>
                </div>';
        })->remove_column('pid')
            ->remove_column('package')
            ->remove_column('payment_for')
            ->remove_column('payment_frequency')
            ->remove_column('offer')
            ->rawColumns([0,1,2,3,4,5,6,7,8,9,10,11,12])
            ->make();
    }

    public function uploadImage(ImageRequest $request) {
        if (!$this->data['user']->can("edit_customers")) {
            return App::abort(401);
        }
        if ($request->ajax()) {

            $output = [];
            $image = Input::file('file');

            $x = intval($request->xCoordOne);
            $y = intval($request->yCoordOne);
            $width = intval($request->profileImageWidth);
            $height = intval($request->profileImageHeight);

            $extension = Input::file('file')->getClientOriginalExtension();
            $filename = Input::get('id') . "-" . rand(10000, 99999) . "." . $extension;
            if(
                !is_null($this->data['gymSettings']->file_storage) || $this->data['gymSettings']->file_storage != '' ||
                !is_null($this->data['gymSettings']->aws_key) || $this->data['gymSettings']->aws_key != '' ||
                !is_null($this->data['gymSettings']->aws_secret) || $this->data['gymSettings']->aws_secret != '' ||
                !is_null($this->data['gymSettings']->aws_region) || $this->data['gymSettings']->aws_region != '' ||
                !is_null($this->data['gymSettings']->aws_bucket) || $this->data['gymSettings']->aws_bucket != ''
            ) {
                $destinationPathMaster = "/uploads/profile_pic/master/$filename";
                $destinationPathThumb = "/uploads/profile_pic/thumb/$filename";


                $image1 = Image::make($image->getRealPath())
                    ->crop($width, $height, $x, $y)
                    ->resize(206, 207);

                $this->uploadImageS3($image1, $destinationPathMaster);

                $image2 = Image::make($image->getRealPath())
                    ->crop($width, $height, $x, $y)
                    ->resize(35, 34);

                $this->uploadImageS3($image2, $destinationPathThumb);
            } else {
                if (!file_exists(public_path()."/uploads/profile_pic/master/") &&
                    !file_exists(public_path()."/uploads/profile_pic/thumb/")) {
                    File::makeDirectory(public_path()."/uploads/profile_pic/master/", $mode = 0777, true, true);
                    File::makeDirectory(public_path()."/uploads/profile_pic/thumb/", $mode = 0777, true, true);
                }
                $destinationPathMaster = public_path()."/uploads/profile_pic/master/$filename";
                $destinationPathThumb = public_path()."/uploads/profile_pic/thumb/$filename";
                $image1 = Image::make($image->getRealPath())
                    ->resizeCanvas($width, $height, 'center', false, 'rgba(0, 0, 0, 0)');
                $image1->save($destinationPathMaster);

                $image2 = Image::make($image->getRealPath())
                    ->resizeCanvas($width, $height, 'center', false, 'rgba(0, 0, 0, 0)')
                    ->resize(40, 40);
                $image2->save($destinationPathThumb);
            }

            $id = Input::get('id');
            $gym_client = GymClient::find($id);
            $gym_client->image = $filename;
            $gym_client->save();

            $output['image'] = $filename;
            return json_encode($output);
        }
        else {
            return "Illegal request method";
        }
    }

    public function uploadImageS3($imageMake, $filePath) {

        if (get_class($imageMake) === 'Intervention\Image\Image') {
            Storage::put($filePath, $imageMake->stream()->__toString(), 'public');
        } else {
            Storage::put($filePath, fopen($imageMake, 'r'), 'public');
        }

    }

    public function saveWebCamImage($id) {

        if (!$this->data['user']->can("edit_customers")) {
            return App::abort(401);
        }

        $image = Input::file('webcam');

        $fileName = $id . "-" . rand(10000, 99999) . ".jpg";
        if($this->data['gymSettings']->local_storage == 0) {
            $destinationPathMaster = "profile_pic/master/$fileName";
            $destinationPathThumb = "profile_pic/thumb/$fileName";

            $image1 = Image::make($image->getRealPath())
                ->resize(206, 155);

            $this->uploadImageS3($image1, $destinationPathMaster);

            $image2 = Image::make($image->getRealPath())
                ->resize(35, 34);

            $this->uploadImageS3($image2, $destinationPathThumb);
        } else {
            if (!file_exists(public_path()."/uploads/profile_pic/master/") &&
                !file_exists(public_path()."/uploads/profile_pic/thumb/")) {
                File::makeDirectory(public_path()."/uploads/profile_pic/master/", $mode = 0777, true, true);
                File::makeDirectory(public_path()."/uploads/profile_pic/thumb/", $mode = 0777, true, true);
            }

            $destinationPathMaster = public_path()."/uploads/profile_pic/master/$fileName";
            $destinationPathThumb = public_path()."/uploads/profile_pic/thumb/$fileName";
            $image1 = Image::make($image->getRealPath())
                ->resize(206, 155);
            $image1->save($destinationPathMaster);

            $image2 = Image::make($image->getRealPath())
                ->resize(35, 34);
            $image2->save($destinationPathThumb);
        }


        $gym_client = GymClient::find($id);
        $gym_client->image = $fileName;
        $gym_client->save();

        $output['image'] = $fileName;
        return $output;
    }


    public function registerEnquiry($id) {
        if (!$this->data['user']->can("add_customers")) {
            return App::abort(401);
        }

        $this->data['title'] = "Add Customer";
        $this->data['enquiry'] = GymEnquiries::gymEnquiry($this->data['user']->detail_id, $id);
        return View::make('gym-admin.gymclients.register_enquiry', $this->data);
    }

    public function import() {
        if (!$this->data['user']->can("add_customers")) {
            return App::abort(401);
        }

        return view("gym-admin.gymclients.import", $this->data);
    }

    public function importUpload() {
        if (!$this->data['user']->can("add_customers")) {
            return App::abort(401);
        }

        $validator = Validator::make(Input::all(), ["file" => "mimes:csv,txt|required|max:4096",]);

        if ($validator->fails()) {
            return [
                "status" => "fail",
                "errors" => $validator->getMessageBag()->toArray()
            ];
        }

        $filename = $this->data["user"]->detail_id . "_" . time() . ".csv";
        $path = storage_path() . "/csvuploads";

        Input::file("file")->move($path, $filename);
        Session::put("importFilePath", $path);
        Session::put("importFileName", $filename);

        return [
            "status" => "success",
            "message" => "File upload successful",
            "action" => "redirect",
            "url" => route("gym-admin.client.match")
        ];
    }

    public function match() {
        $path = Session::get("importFilePath");
        $fileName = Session::get("importFileName");

        if ($path == "" || $path == null) {
            App::abort("500");
        }

        $result = $this->csvDataForFilter($path . "/" . $fileName);

        if ($result["count"] > GymClient::$MAX_CLIENTS + 1) {
            $this->data["message"] = "You are not allowed to import more than " . GymClient::$MAX_CLIENTS . " clients at a time";
            return view("admin.errors.error", $this->data);
        }

        $this->data = array_merge($this->data, $result);

        return view("gym-admin.gymclients.match", $this->data);
    }

    private function csvDataForFilter($filePath) {
        $csvFields = [];
        $csvHeadingFields = [];

        // IF you make a change here, also change in importProcess function
        $leadFields = [
            ["id" => "static-1", "name" => "Name", "required" => "Yes"],
            ["id" => "static-2", "name" => "Date of Birth", "required" => "No"],
            ["id" => "static-3", "name" => "Gender", "required" => "Yes"],
            ["id" => "static-4", "name" => "Email", "required" => "Yes"],
            ["id" => "static-5", "name" => "Mobile", "required" => "Yes"],
            ["id" => "static-6", "name" => "Date of Joining", "required" => "No"],
            ["id" => "static-9", "name" => "Address", "required" => "No"],
        ];

        $formColumnDetailsByID = [];

        foreach ($leadFields as $leadField) {
            $formColumnDetailsByID[$leadField["id"]] = $leadField["name"];
        }

        $delimiter = ",";

        // Opening file for Reading and fetching Data
        $file = fopen($filePath, "r");

        $count = 1;
        while (!feof($file)) {

            if ($count < 6) {
                if ($delimiter == "\t") {
                    $line = fgets($file);
                    $words = explode("\t", $line);
                    $finalLine = "";
                    foreach ($words as $word) {
                        $finalLine = $finalLine . (($finalLine == "") ? "" : ",") . "\"" . addslashes($word) . "\"";
                    }
                    $newRows = str_getcsv($finalLine);
                }
                else {
                    $newRows = fgetcsv($file);
                }

                if (!empty($newRows)) {
                    if ($count == 1) {
                        foreach ($newRows as $key => $value) {
                            $csvHeadingFields[$key] = $value;
                        }
                    }
                    else {
                        foreach ($newRows as $key => $value) {
                            $csvFields[$key][] = $value;
                        }
                    }
                }
            }

            if ($count >= GymClient::$MAX_CLIENTS + 1) {
                break;
            }

            $count++;
        }
        fclose($file);

        $matchedColumns = array_fill(0, count($csvHeadingFields), false);
        $matchedColumnsDetail = array_fill(0, count($csvHeadingFields), -1);
        $matchCount = 0;
        $leadMatchedColumns = [];

        foreach ($csvHeadingFields as $key => $value) {
            $currentCsvHeadingField = strtolower(str_replace([' ',
                '_'], '', trim($value)));

            foreach ($leadFields as $leadField) {
                $currentFromColumnField = strtolower(str_replace([' ',
                    '_'], '', trim($leadField["name"])));

                if ($currentCsvHeadingField == $currentFromColumnField) {
                    $matchedColumns[$key] = true;
                    $matchedColumnsDetail[$key] = $leadField['id'];
                    $leadMatchedColumns[$leadField['id']] = 1;
                    $matchCount++;
                    break;
                }
            }
        }

        $result = [];
        $result['csvFields'] = $csvFields;
        $result['csvHeadingFields'] = $csvHeadingFields;
        $result['leadFields'] = $leadFields;
        $result['formColumnDetailsByID'] = $formColumnDetailsByID;
        $result['matchedColumns'] = $matchedColumns;
        $result['unmatchCount'] = count($leadFields) - $matchCount;
        $result['matchedColumnsDetail'] = $matchedColumnsDetail;
        $result['matchCount'] = $matchCount;
        $result['leadMatchedColumns'] = $leadMatchedColumns;
        $result['count'] = $count;

        return $result;
    }

    public function importProcess() {
        set_time_limit(0);

        $leadFields = [
            ["id" => "static-1", "name" => "Name", "required" => "Yes"],
            ["id" => "static-2", "name" => "Date of Birth", "required" => "No"],
            ["id" => "static-3", "name" => "Gender", "required" => "Yes"],
            ["id" => "static-4", "name" => "Email", "required" => "Yes"],
            ["id" => "static-5", "name" => "Mobile", "required" => "Yes"],
            ["id" => "static-6", "name" => "Date of Joining", "required" => "No"],
            ["id" => "static-9", "name" => "Address", "required" => "No"]
        ];

        $formColumnDetailsByID = [];

        foreach ($leadFields as $leadField) {
            $formColumnDetailsByID[$leadField["id"]] = $leadField["name"];
        }

        //            $company_id = $this->data["company_id"];

        $date = new \DateTime();
        Session::put('step4StartingTime', $date);

        $mapping = Input::get("sorting");

        //Getting Csv File and campaignID From Session Variable

        $filePath = Session::get('importFilePath');
        $fileName = Session::get('importFileName');

        // Key to store progress in cache
        $cacheKey = "importProgress" . $this->data['user']->id;
        $expire = Carbon::now('Asia/Calcutta')->addMinutes(360);
        Cache::put($cacheKey, "0", $expire);

        $duplicates = 0;
        if (!empty($filePath)) {
            //Array From Step 3
            $mappingArray = json_decode($mapping, false);

            // We flip array so that we can get which csv column is mapped to given field id
            $mappingFieldArray = array_flip($mappingArray);

            // Fill in remaining fields

            foreach ($leadFields as $leadField) {
                if (!isset($mappingFieldArray[$leadField["id"]])) {
                    $mappingFieldArray[$leadField["id"]] = -1;
                }
            }

            //                //Array Store FormsID which are not selected
            //                $remainingMappingArray = [];
            //                $doneMappingArray = [];
            //
            //                $formColumns = $leadFields;
            //
            //                foreach ($formColumns as $formColumn) {
            //                    if (in_array($formColumn["id"], $mappingArray) == false) {
            //                        $remainingMappingArray[ $formColumn->id ] = $formColumn->fieldName;
            //                    }
            //                    else {
            //                        $doneMappingArray[] = $formColumn->id;
            //                    }
            //                }
            //
            //                $csvOrTsvIndicator = substr($filePath, strrpos($filePath, "/") + 1, 1);

            $delimiter = ",";

            //Opening file for Reading and fetching Data
            $file = fopen($filePath . "/" . $fileName, "r");

            // We measure progress as number of bytes processed
            $fileBytes = filesize($filePath . "/" . $fileName);

            $count = 1;
            $totalLeadCustomDataAdded = 0;

            DB::beginTransaction();

            $failedRecords = [];
            $csvHeading = [];

            try {
                while (!feof($file)) {
                    $newRows = fgetcsv($file, 0, $delimiter);

                    if (!empty($newRows) && $count > 1) {

                        try {
                            // Array which store those field which may be inserted
                            $newInsertedDataArray = [];
                            $newRows[-1] = "";
                            // Create a new employee or update existing employee
                            // TODO: Add option in front end to choose if yo update existing update

                            $client = GymClient::withTrashed()->where("email", trim($newRows[$mappingFieldArray["static-4"]]))
                                ->join('business_customers', 'business_customers.customer_id', '=', 'gym_clients.id')
                                ->where('business_customers.detail_id', $this->data['user']->detail_id)
                                ->first();

                            // Create new client if not exist
                            if (!$client) {
                                $client = new GymClient();


                                $client->first_name = trim($newRows[$mappingFieldArray["static-1"]]);

                                $client->email = trim($newRows[$mappingFieldArray["static-4"]]);


                                $client->gender = strtolower(trim($newRows[$mappingFieldArray["static-3"]]));
                                $client->mobile = trim($newRows[$mappingFieldArray["static-5"]]);
                                $client->dob = $this->parseDate($newRows[$mappingFieldArray["static-2"]]);

                                $client->joining_date = $this->parseDate($newRows[$mappingFieldArray["static-6"]]);
                                $client->address = trim($newRows[$mappingFieldArray["static-9"]]);
                                $client->password = Hash::make('123456');
                                $client->save();

                                $businessCustomer = new BusinessCustomer();
                                $businessCustomer->detail_id = $this->data['user']->detail_id;
                                $businessCustomer->customer_id = $client->id;
                                $businessCustomer->save();

                                $promoDb = ['name' => $client->first_name, 'email' => $client->email, 'number' => $client->mobile];
                                $this->addPromotionDatabase($promoDb);


//                                if (trim($newRows[$mappingFieldArray["static-12"]]) != '') {
//
//                                    // Check membership name exists
//                                    $membership = GymMembership::membershipByName(trim($newRows[$mappingFieldArray["static-12"]]), $this->data['user']->detail_id);
//                                    if (!is_null($membership)) {
//
//                                        // Create purchase record
//                                        $purchase = new GymPurchase();
//                                        $purchase->client_id = $client->id;
//                                        $purchase->payment_for = 'membership';
//                                        $purchase->purchase_amount = $membership->price;
//                                        $purchase->amount_to_be_paid = $membership->price;
//                                        $purchase->membership_id = $membership->id;
//                                        $purchase->paid_amount = trim($newRows[$mappingFieldArray["static-10"]]);
//
//                                        $purchase->purchase_date = Carbon::today('Asia/Calcutta');
//                                        $purchase->start_date = Carbon::today('Asia/Calcutta');
//                                        $purchase->detail_id = $this->data['user']->detail_id;
//
//                                        if (trim($newRows[$mappingFieldArray["static-13"]])) {
//                                            $purchase->payment_required = 'yes';
//                                            $purchase->next_payment_date = $this->parseDate($newRows[$mappingFieldArray["static-14"]]);
//                                        }
//                                        $purchase->save();
//
//                                        // Create payment record
//                                        $payment = new GymMembershipPayment();
//                                        $payment->user_id = $client->id;
//                                        $payment->payment_amount = trim($newRows[$mappingFieldArray["static-10"]]);
//
//                                        $payment->purchase_id = $purchase->id;
//
//                                        $payment->payment_source = "cash";
//                                        $payment->payment_date = $this->parseDate($newRows[$mappingFieldArray["static-11"]]);
//
//                                        $payment->payment_type = null;
//
//                                        $payment->detail_id = $this->data['user']->detail_id;
//                                        $payment->save();
//
//                                        $payment->payment_id = 'HPR' . $payment->id;
//                                        $payment->save();
//
//                                    }
//                                }

                            }

                        } catch (\PDOException $e) {
                            $newRows["failReason"] = "Database Error";
                            unset($newRows[-1]);
                            $failedRecords[] = $newRows;

                            $data = @array_combine($csvHeading, $failedRecords);

                            DB::table("failed_records")->insert([
                                "data" => json_encode($data, JSON_PRETTY_PRINT | JSON_PARTIAL_OUTPUT_ON_ERROR),
                                "fail_reason" => $e->getMessage()
                            ]);
                        } catch (\Exception $e) {
                            $newRows["failReason"] = $e->getMessage();
                            unset($newRows[-1]);
                            $failedRecords[] = $newRows;

                            $data = @array_combine($csvHeading, $failedRecords);

                            DB::table("failed_records")->insert([
                                "data" => json_encode($data, JSON_PRETTY_PRINT | JSON_PARTIAL_OUTPUT_ON_ERROR),
                                "fail_reason" => $e->getMessage()
                            ]);
                        }
                    }
                    else if (!empty($newRows)) {
                        $csvHeading = $newRows;
                        $csvHeading[] = "Fail Reason";
                    }

                    $count++;

                    $currentPosition = ftell($file);

                    $processingCompleted = ($currentPosition / $fileBytes) * 100;

                    \Cache::put($cacheKey, $processingCompleted, $expire);
                }
            } catch (\Exception $e) {
                \DB::rollBack();

                return \Response::make("Error importing data. No changes were made. Please contact support with error: " . $e->getMessage(), 500);
            }

            \DB::commit();

            fclose($file);
            \Session::put('failedRecords', $failedRecords);
            \Session::put('csvHeading', $csvHeading);
        }


        $data = [];
        $data['status'] = 'success';

        return json_encode($data);
    }

    public function checkImportProgress() {

        $cacheKey = "importProgress" . $this->data['loggedAdmin']->id;
        $processingCompleted = \Cache::get($cacheKey);

        return $processingCompleted;
    }

    public function cancelImport() {
        \File::delete(\Session::get("importFilePath") . "/" . \Session::get("importFileName"));
        \Session::remove("importFilePath");
        \Session::remove("importFileName");

        $cacheKey = "importProgress" . $this->data['loggedAdmin']->id;
        \Cache::forget($cacheKey);
    }

    public function failedRecords() {
        $failedRecords = \Session::get("failedRecords");
        $csvHeading = \Session::get("csvHeading");


        $this->data["failedRecords"] = $failedRecords;
        $this->data["csvHeading"] = $csvHeading;

        return view("gym-admin.gymclients.failed_records", $this->data);
    }

    public function downloadFailedRecords() {
        $failedRecords = \Session::get("failedRecords");
        $csvHeading = \Session::get("csvHeading");

        $path = storage_path() . "/csvuploads/failed_records_" . Carbon::now('Asia/Calcutta')->format("Y-m-d") . ".csv";

        $file = fopen($path, "w");

        fputcsv($file, $csvHeading);

        foreach ($failedRecords as $record) {
            fputcsv($file, $record);
        }

        fclose($file);

        return \Response::download($path);
    }

    private function parseDate($date) {
        try {
            return Carbon::createFromFormat('d/m/y', $date)->format("Y-m-d");
        } catch (\Exception $e) {
            return Carbon::parse($date)->format("Y-m-d");
        }
    }


}