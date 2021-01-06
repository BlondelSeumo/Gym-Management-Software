<?php

namespace App\Http\Controllers\GymAdmin;


use App\Models\GymTutorial;

class GymAdminTutorialController extends GymAdminBaseController
{

    public function index() {
        $this->data['title'] = "Fitsigma Tutorials";
        $this->data['tutorials'] = GymTutorial::all();
        return view('gym-admin.tutorial.index', $this->data);
    }

    public function show($id) {
        $this->data['tutorial'] = GymTutorial::find($id);
        return view('gym-admin.tutorial.show', $this->data);
    }

}
