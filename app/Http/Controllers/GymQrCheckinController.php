<?php

namespace App\Http\Controllers;

use App\Models\GymClient;
use App\Models\GymClientAttendance;
use Carbon\Carbon;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;

class GymQrCheckinController extends Controller
{

    public function qrCodeCheckIn($url) {

        try {
            $url = Crypt::decrypt($url);
            $url = substr($url, 7);
            $url = explode('-', $url);
            $clientId = $url[0];

            $date = Carbon::now('Asia/Calcutta');

            $client = GymClient::find($clientId);

            if(is_null($client)){
                throw new DecryptException();
            }

            $attendance = GymClientAttendance::where('client_id', $clientId)
                ->where(DB::raw("DATE(`check_in`)"), $date->format('Y-m-d'))
                ->first();

            if(is_null($attendance)){

                $checkIn = 'success';

                $attendance = GymClientAttendance::markAttendance($clientId, $date);

                return response()->json(
                    [
                        'status' => 'success',
                        'message' => ucfirst($client->first_name). ' checked in at '.$attendance->check_in->format('h:i A')
                    ]
                );

//                return view('gym-admin.attendance.qr_check_in', compact('client', 'checkIn', 'attendance'));
            }
            else{
                $checkIn = 'fail';

                return response()->json(
                    [
                        'status' => 'fail',
                        'message' => 'Already checked in at '.$attendance->check_in->format('h:i A')
                    ]
                );

//                return view('gym-admin.attendance.qr_check_in', compact('client', 'checkIn', 'attendance'));
            }


        } catch (DecryptException $e) {
            return '<h1>Invalid Check In</h1>';
        }

    }

}
