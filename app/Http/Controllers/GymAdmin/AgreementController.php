<?php

namespace App\Http\Controllers\GymAdmin;

use Illuminate\Http\Request;

class AgreementController extends GymAdminBaseController
{
    public function __construct() {
        parent::__construct();
    }

    public function index(){
        return view('gym-admin.agreement.index', $this->data);
    }
}
