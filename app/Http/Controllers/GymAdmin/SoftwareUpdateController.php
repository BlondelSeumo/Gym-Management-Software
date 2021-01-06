<?php

namespace App\Http\Controllers\GymAdmin;


use App\Helper\Reply;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Models\SoftwareUpdate;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class SoftwareUpdateController extends GymAdminBaseController
{

    public function __construct() {
        parent::__construct();
        $this->data['updatesMenu'] = 'active';
    }

    public function index() {
        if(!$this->data['user']->can("view_software_updates"))
        {
            return App::abort(401);
        }

        $this->data['UpcomingInfo'] = SoftwareUpdate::GetUpcomingInfo();
        $this->data['title'] = "Upcoming Updates";
        return View::make('gym-admin.software-update.index', $this->data);
    }

}
