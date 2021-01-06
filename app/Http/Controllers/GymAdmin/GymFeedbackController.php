<?php

namespace App\Http\Controllers\GymAdmin;

use App\Models\Review;
use App\Models\Reviewcomment;
use Illuminate\Http\Request;
use App\Helper\Reply;
use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class GymFeedbackController extends GymAdminBaseController
{

    public function __construct() {
        parent::__construct();
        $this->data['manageMenu'] = 'active';
        $this->data['feedbackMenu'] = 'active';
    }

    public function index() {
        if (!$this->data['user']->can("view_feedback")) {
            return App::abort(401);
        }

        if($this->data['common_details']->huntplex_listing == 'no'){
            return App::abort(401);
        }

        $this->data['title'] = 'FeedBack';
        $this->data['reviews'] = Review::where('detail_id', '=', $this->data['user']->detail_id)
            ->orderBy('id', 'desc')
            ->get();
        $this->data['totalReviews'] = Review::where('detail_id', '=', $this->data['user']->detail_id)
            ->where('review_text', '<>', '')
            ->where('status', '=', 'approved')
            ->count();
        return View::make('gym-admin.feedback.index', $this->data);
    }

    public function ajaxLoadComments() {
        if (!$this->data['user']->can("view_feedback")) {
            return App::abort(401);
        }

        $reviewId = Input::get('id');
        $this->data['comments'] = Reviewcomment::where('review_id', '=', $reviewId)->orderBy('id', 'desc')->take(2)->get();
        $this->data['total'] = Reviewcomment::where('review_id', '=', $reviewId)->count();
        $this->data['count'] = count($this->data['comments']);

        return View::make('gym-admin.feedback.ajaxloadcomments', $this->data);
    }

    public function loadMoreComments() {
        if (!$this->data['user']->can("view_feedback")) {
            return App::abort(401);
        }

        $take = Input::get('take');
        $skip = Input::get('skip');
        $reviewID = Input::get('id');

        $this->data['comments'] = Reviewcomment::reviewComments($reviewID, $take, $skip);
        $this->data['total'] = 0;
        $this->data['count'] = 0;

        return View::make('gym-admin.feedback.ajaxloadcomments', $this->data);
    }

    public function postReply() {
        if (!$this->data['user']->can("view_feedback")) {
            return App::abort(401);
        }

        $validator = Validator::make(Input::all(), ['reply' => 'required', 'id' => 'required']);
        if ($validator->fails()) {
            $output['success'] = false;
            $output['class'] = 'alert alert-danger';
            $output['error'] = implode('<br><i class="fa fa-close" ></i> ', $validator->messages()
                ->all());
        }
        else {
            $reviewId = Input::get('id');
            $reply_text = Input::get('reply');
            $reply = new Reviewcomment();
            $reply->review_id = $reviewId;
            $reply->comment = $reply_text;
            $reply->user_id = null;
            $reply->user_read = 'No';
            $reply->merchant_id = $this->data['user']->id;
            $reply->save();
            $output['success'] = true;
            $output['class'] = 'alert alert-info';
            $output['error'] = 'Reply Posted Successfully';
        }
        return json_encode($output);
    }


    public function removeReply($id) {
        if (!$this->data['user']->can("view_feedback")) {
            return App::abort(401);
        }

        $this->data['comment'] = Reviewcomment::select('comment', 'id')->where('id', '=', $id)->first();
        return View::make('gym-admin.feedback.destroy', $this->data);
    }

    public function destroy($id) {
        if (!$this->data['user']->can("view_feedback")) {
            return App::abort(401);
        }

        $client = Reviewcomment::find($id);
        $client->delete();
        return Reply::redirect(route('gym-admin.feedback.index'), "Reply Removed successfully");
    }

    public function edit() {
        if (!$this->data['user']->can("view_feedback")) {
            return App::abort(401);
        }

        $comment = Input::get('reply');
        $data = Reviewcomment::find(Input::get('id'));
        $data->comment = $comment;
        $data->save();
        $output['success'] = true;
        $output['class'] = 'alert alert-info';
        $output['error'] = 'Reply Updated Successfully';
        return json_encode($output);
    }

}
