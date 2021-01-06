<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Mail\Notification;
use App\Models\GymClient;
use App\Models\Message;
use App\Models\MessageThread;
use App\Notifications\CustomerMessageNotification;
use Illuminate\Http\Request;

class GymAdminMessageController extends GymAdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->data['manageMenu'] = 'active';
        $this->data['messageMenu'] = 'active';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = "Message";
        $this->data['inboxActive'] = 'active';
        $this->data['messages'] = MessageThread::select('messages.to', 'messages.from',
            'messages.text', 'messages.mark_as', 'message_threads.customer_id', 'message_threads.merchant_id',
            'messages.created_at', 'messages.thread_id')
            ->leftJoin('messages', 'messages.thread_id', '=', 'message_threads.id')
            ->where('merchant_id', '=', $this->data['user']->id)
            ->where('detail_id', '=', $this->data['user']->detail_id)
            ->orderBy('messages.created_at', 'desc')
            ->get()
            ->unique('thread_id');
        $this->data['unreadMessages'] = $this->unreadMessages($this->data['user']);

        return view('gym-admin.message.detail', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['unreadMessages'] = $this->unreadMessages($this->data['user']);
        $this->data['customers'] = GymClient::join('business_customers',
            'business_customers.customer_id', '=', 'gym_clients.id')
            ->where('business_customers.detail_id', '=', $this->data['merchantBusiness']->detail_id)
            ->select('gym_clients.id', 'gym_clients.first_name', 'gym_clients.last_name')
            ->get();

        return view('gym-admin.message.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messageThread = new MessageThread();
        $messageThread->customer_id = $request->customer_id;
        $messageThread->merchant_id = $this->data['user']->id;
        $messageThread->detail_id = $this->data['user']->detail_id;
        $messageThread->save();

        $message = new Message();
        $message->thread_id = $messageThread->id;
        $message->to = 'customer';
        $message->from = 'merchant';
        $message->text = $request->text;
        $message->save();

        $user = GymClient::find($request->customer_id);
        $user->notify(new CustomerMessageNotification($message));

        return Reply::redirect(route('gym-admin.message.index'), 'Message Sent successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $messages = Message::select('id')
            ->where('thread_id', '=', $id)
            ->get();

        //region mark message as read
        foreach ($messages as $message) {
            $messageUpdate = Message::find($message->id);
            $messageUpdate->mark_as = 'read';
            $messageUpdate->save();
        }
        //endregion

        $this->data['inboxActive'] = 'active';
        $this->data['messages'] = MessageThread::select('messages.to', 'messages.from',
            'messages.text', 'messages.mark_as', 'message_threads.customer_id', 'message_threads.merchant_id',
            'messages.created_at', 'messages.thread_id')
            ->leftJoin('messages', 'messages.thread_id', '=', 'message_threads.id')
            ->where('merchant_id', '=', $this->data['user']->id)
            ->where('detail_id', '=', $this->data['user']->detail_id)
            ->where('messages.thread_id', '=', $id)
            ->orderBy('messages.created_at', 'asc')
            ->get();
        $this->data['unreadMessages'] = $this->unreadMessages($this->data['user']);

        return view('gym-admin.message.show', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = new Message();
        $message->thread_id = $id;
        $message->to = 'customer';
        $message->from = 'merchant';
        $message->text = $request->message;
        $message->mark_as = 'unread';
        $message->save();

        $customerId = MessageThread::find($id)->customer_id;
        $user = GymClient::find($customerId);
        $user->notify(new CustomerMessageNotification($message));

        return Reply::dataOnly(['message' => $message->text]);
    }

    /**
     * @param $merchantValue
     * @return int
     */
    private function unreadMessages($merchantValue)
    {
        return MessageThread::leftJoin('messages', 'messages.thread_id', '=', 'message_threads.id')
            ->where('message_threads.merchant_id', '=', $merchantValue->id)
            ->where('message_threads.detail_id', '=', $merchantValue->detail_id)
            ->where('messages.to', '=', 'merchant')
            ->where('messages.mark_as', '=', 'unread')
            ->count();
    }
}
