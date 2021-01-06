<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Models\GymClientAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;

class GymAdminAttendanceController extends GymAdminBaseController
{

    public function __construct() {
        parent::__construct();
        $this->data['manageMenu'] = 'active';
        $this->data['attendanceMenu'] = 'active';
    }

    public function index() {

        $this->data['title'] = "Client Attendance";

        return view('gym-admin.attendance.index', $this->data);
    }

    public function create() {
        if (!$this->data['user']->can("add_attendance")) {
            return App::abort(401);
        }

        $this->data['title'] = "Client Attendance";

        return view('gym-admin.attendance.create', $this->data);
    }

    public function markAttendance(Request $request) {
        if (!$this->data['user']->can("add_attendance")) {
            return App::abort(401);
        }
        
        $date = Carbon::createFromFormat('d/M/Y H:ia', Input::get('date'))->format('Y-m-d H:i:s');
        $data = GymClientAttendance::markAttendance($request->input('clientId'), $date);
        return Reply::successWithData("Attendance marked successfully.", ['id' => $data->id]);
    }

    public function checkin($Id) {
        $this->data['id'] = $Id;
        return View::make('gym-admin.attendance.checkin', $this->data);
    }

    public function destroy($id) {
        GymClientAttendance::destroy($id);
        return Reply::success("Checkin deleted successfully.");

    }

    public function ajax_create(Request $request) {
        if (!$this->data['user']->can("add_attendance")) {
            return App::abort(401);
        }

        $date = Carbon::createFromFormat('d/M/Y', $request->date)->format('Y-m-d');
        $search = $request->search_data;
        $client_attandence = GymClientAttendance::clientAttendanceByDate($date, $search, $this->data['user']->detail_id);

        return Datatables::of($client_attandence)
            ->edit_column('id', function ($row) {
                return view('gym-admin.attendance.ajaxview', ['row' => $row, 'imageURL' => $this->data['profileHeaderPath'], 'gymSettings' => $this->data['gymSettings'], 'deaultImageURL'=> $this->data['profilePath']])->render();
            })
            ->remove_column('first_name')
            ->remove_column('last_name')
            ->remove_column('joining_date')
            ->remove_column('check_in')
            ->remove_column('status')
            ->remove_column('image')
            ->remove_column('checkin_id')
            ->remove_column('total_checkin')
            ->make();
    }

}