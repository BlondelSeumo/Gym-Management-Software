<?php

namespace App\Http\Controllers\Customer;

use App\Models\GymClient;
use App\Models\GymClientAttendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class CustomerAttendanceController extends CustomerBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['attendanceMenu'] = 'active';
        $this->data['attendance'] = GymClientAttendance::where('client_id', '=', $this->data['customerValues']->id)
            ->get();
        $this->data['client'] = GymClient::find($this->data['customerValues']->id);

        return view('customer-app.attendance.index', $this->data);
    }
}
