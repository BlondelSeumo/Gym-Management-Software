<?php

namespace App\Http\Controllers\GymAdmin;

use App\Helper\Reply;
use App\Models\BusinessSubCategory;
use App\Models\Gym;
use App\Models\GymMembership;
use App\Models\GymOffer;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Yajra\Datatables\Facades\Datatables;

class GymOfferMangeController extends GymAdminBaseController
{

    public function __construct() {
        parent::__construct();
        $this->data['manageMenu'] = 'active';
        $this->data['offerMenu'] = 'active';
    }

    public function index() {
        if (!$this->data['user']->can("view_offer")) {
            return App::abort(401);
        }

        if($this->data['common_details']->huntplex_listing == 'no'){
            return App::abort(401);
        }

        $this->data['title'] = 'Offers';
        return View::make('gym-admin.offers.index', $this->data);
    }

    public function ajax_create() {
        if (!$this->data['user']->can("view_offer")) {
            return App::abort(401);
        }

        $offers = GymOffer::select('id', 'title', 'valid_from', 'valid_to', 'original_price', 'discounted_price', 'offer_for', 'status')
            ->where('detail_id', '=', $this->data['user']->detail_id);
        return Datatables::of($offers)
            ->edit_column('title', function ($row) {
                return ucwords($row->title);
            })
            ->edit_column('valid_from', function ($row) {
                return $row->valid_from->format('d-M-Y');
            })
            ->edit_column('valid_to', function ($row) {
                return $row->valid_to->format('d-M-Y');
            })
            ->edit_column('offer_for', function ($row) {
                if ($row->offer_for == 'both') {
                    return 'Men & Women';
                }
                else {
                    return ucwords($row->offer_for);
                }
            })
            ->edit_column('status', function ($row) {
                if ($row->status == 'active') {
                    return '<label class="label label-success">ACTIVE</label>';
                }
                elseif ($row->status == 'inactive') {
                    return '<label class="label label-danger">INACTIVE</label>';
                }
                elseif ($row->status == 'pending') {
                    return '<label class="label label-warning">Pending For Approval</label>';
                }
            })
            ->add_column('action', function ($row) {
                return "<button  onClick='editOffer(" . $row->id . ")' class=\"btn col-xs-12 purple\"><i class='fa fa-edit'></i>
                        Edit
                     </button>
                    <a href='javascript:;' class=\"btn uppercase col-xs-12 blue-chambray \" onClick=Delete(" . $row->id . ")><i class='fa fa-trash'></i> Delete</a>";
            })
            ->remove_column('id')
            ->rawColumns([6,7])
            ->make();
    }

    public function create() {
        if (!$this->data['user']->can("add_offer")) {
            return App::abort(401);
        }

        $business = BusinessSubCategory::select('sub_category.name', 'business_sub_category.id as id')
            ->leftJoin('sub_category', 'sub_category.id', '=', 'business_sub_category.sub_category_id')
            ->where('detail_id', '=', $this->data['user']->detail_id)->get();
        $memberships = GymMembership::select('id', 'title', 'business_sub_category_id as cat_id', 'price')
            ->where('detail_id', '=', $this->data['user']->detail_id)->get();
        $gymMembership = array();
        foreach ($memberships as $key => $membership) {
            foreach ($business as $b) {
                if ($membership->cat_id == $b->id) {
                    $gymMembership[$b->name][$key] = $membership;
                }
            }
        }

        $this->data['memberships'] = $gymMembership;
        return View::make('gym-admin.offers.create', $this->data);
    }

    public function store(Request $request) {

        if (!$this->data['user']->can("add_offer")) {
            return App::abort(401);
        }

        $validator = Validator::make(Input::all(), GymOffer::rules('add'));

        if ($validator->fails()) {
            return Reply::formErrors($validator);
        }
        else {
            $offer = new GymOffer();
            $offer->title = Input::get('title');
            $offer->details = Input::get('description');
            $offer->valid_from = Carbon::createFromFormat('m/d/Y', Input::get('valid_from'))->format('Y-m-d');
            $offer->valid_to = Carbon::createFromFormat('m/d/Y', Input::get('valid_too'))->format('Y-m-d');
            $offer->original_price = Input::get('original_price');
            $offer->discounted_price = Input::get('discounted_price');
            $offer->offer_for = Input::get('offer_for');
            $offer->status = 'pending';
            $offer->detail_id = $this->data['user']->detail_id;
            $offer->membership_id = Input::get('membership_id');

            if ($request->file('file')) {
                $image = $request->file;
                $imageMake = Image::make($image->getRealPath());
                $imageMake->insert(public_path('watermark.png'), 'center');
                $extension = $image->getClientOriginalExtension();
                $filename = $offer->title . '-' . $this->data['common_details']->slug .'-'.rand(10000, 99999) .'.' . $extension;

                $filePath = '/gyms_offers/'.$filename;

                if(get_class($imageMake) === 'Intervention\Image\Image') {
                    Storage::put($filePath, $imageMake->stream()->__toString(), 'public');
                } else {
                    Storage::put($filePath, fopen($imageMake, 'r'), 'public');
                }
                $offer->image = $filename;
            }
            $offer->save();
            return Reply::redirect(route('gym-admin.offers.index'), 'New offer has been created and is being reviewed. It will be live shortly.');

        }
    }

    public function show($id) {
        if (!$this->data['user']->can("edit_offer")) {
            return App::abort(401);
        }

        $this->data['offer'] = GymOffer::find($id);
        $business = BusinessSubCategory::select('sub_category.name', 'business_sub_category.id as id')
            ->leftJoin('sub_category', 'sub_category.id', '=', 'business_sub_category.sub_category_id')
            ->where('detail_id', '=', $this->data['user']->detail_id)->get();
        $memberships = GymMembership::select('id', 'title', 'business_sub_category_id as cat_id', 'price')
            ->where('detail_id', '=', $this->data['user']->detail_id)->get();
        $gymMembership = array();
        foreach ($memberships as $key => $membership) {
            foreach ($business as $b) {
                if ($membership->cat_id == $b->id) {
                    $gymMembership[$b->name][$key] = $membership;
                }
            }
        }

        $this->data['memberships'] = $gymMembership;
        return View::make('gym-admin.offers.edit', $this->data);
    }

    public function update($id, Request $request) {
        if (!$this->data['user']->can("edit_offer")) {
            return App::abort(401);
        }

        $validator = Validator::make(Input::all(), GymOffer::rules(Input::get('type')));
        if ($validator->fails()) {
            return Reply::formErrors($validator);
        }
        else {
            $offer = GymOffer::find($id);

            if (Input::get('type') == 'data') {
                $offer->title = Input::get('title');
                $offer->details = Input::get('description');
                $offer->valid_from = Carbon::createFromFormat('m/d/Y', Input::get('valid_from'))->format('Y-m-d');
                $offer->valid_to = Carbon::createFromFormat('m/d/Y', Input::get('valid_too'))->format('Y-m-d');
                $offer->original_price = Input::get('original_price');
                $offer->discounted_price = Input::get('discount_price');
                $offer->offer_for = Input::get('offer_for');
                $offer->status = Input::get('status');
                $offer->detail_id = $this->data['user']->detail_id;
                $offer->membership_id = Input::get('membership_id');
            }
            else {
                if ($request->file('file')) {
                    $image = $request->file;
                    $imageMake = Image::make($image->getRealPath());
                    $imageMake->insert(public_path('watermark.png'), 'center');
                    $extension = $image->getClientOriginalExtension();
                    $filename = $offer->title . '-' . $this->data['common_details']->slug .'-'.rand(10000, 99999) .'.' . $extension;

                    $filePath = '/gyms_offers/'.$filename;

                    if(get_class($imageMake) === 'Intervention\Image\Image') {
                        Storage::put($filePath, $imageMake->stream()->__toString(), 'public');
                    } else {
                        Storage::put($filePath, fopen($imageMake, 'r'), 'public');
                    }
                    $offer->image = $filename;
                }
            }
            $offer->save();
            return Reply::redirect(route('gym-admin.offers.index'), 'Your offer has been edited successfully');

        }
    }

    public function destroy($id) {
        if (!$this->data['user']->can("delete_offer")) {
            return App::abort(401);
        }

        GymOffer::destroy($id);

        return Reply::redirect(route('gym-admin.offers.index'), 'Offer deleted successfully');
    }
}
