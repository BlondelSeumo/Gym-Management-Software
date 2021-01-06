<?php

namespace App\Http\Controllers\GymAdmin;

use App\Helper\Reply;
use App\Models\MediaManagement;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;

class GymMediaController extends GymAdminBaseController
{

    public function __construct() {
        parent::__construct();
        $this->data['manageMenu'] = 'active';
        $this->data['mediaMenu'] = 'active';
    }

    public function index() {
        if(!$this->data['user']->can("view_media"))
        {
            return App::abort(401);
        }

        $this->data['title'] = 'Media';
        return View::make('gym-admin.media.index', $this->data);
    }

    public function store() {
        if(!$this->data['user']->can("add_media"))
        {
            return App::abort(401);
        }

        $validator = Validator::make(Input::all(), MediaManagement::$rules);

        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }
        else {

            $file = Input::file('files');

            $type = explode('/', $file->getMimeType())[0];

            if($type != 'video') {
                $type = 'photo';
            }

            $media = new MediaManagement();
            $media->description = 'GYM';
            $media->type = $type;
            $media->detail_id = $this->data['user']->detail_id;
            $media->save();
            $path = public_path() . "/admin/uploads/gym_clients/media/".$type.'/';
            File::makeDirectory($path, $mode = 0777, true, true);
            $extension = $file->getClientOriginalExtension();
            $file_size = $file->getSize();
            $filename  = $this->data['merchantBusiness']->business->slug.'-video-'.$media->id.'.'.$extension;
            $file->move($path, $filename);
            $media->title = $filename;
            $media->save();

            return [
                "files" => [
                    "0" => [
                        "name" => $filename,
                        "size" => $file_size,
                        "thumbnailUrl" => asset('admin/uploads/gym_clients/media/image').'/'.$filename
                    ]
                ]
            ];

        }
    }

    public function ajax_create() {
        if(!$this->data['user']->can("view_media"))
        {
            return App::abort(401);
        }

        $media = MediaManagement::select('title', 'type', 'status', 'created_at')
            ->where('detail_id', '=', $this->data['user']->detail_id);
        return Datatables::of($media)
            ->edit_column('status', function($row){
                if($row->status == 'pending')
                {
                    return'<span class="label label-danger"> Pending </span>';
                }else
                {
                    return '<span class="label label-primary"> Approved </span>';
                }
            })
            ->edit_column('created_at', function($row){
                return $row->created_at->toFormattedDateString();
            })
            ->rawColumns([0,2])
            ->make();
    }

}
