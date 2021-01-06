<?php

namespace App\Http\Controllers\Customer;

use App\Classes\Reply;
use App\Http\Requests\CustomerApp\Message\SendMailRequest;
use App\Models\GymMerchantRole;
use App\Models\MerchantNotification;
use App\Models\Message;
use App\Models\MessageThread;
use Illuminate\Http\Request;

class CustomerMessageController extends CustomerBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['messageMenu'] = 'active';
        $this->data['messages'] = MessageThread::select('messages.to', 'messages.from',
            'messages.text', 'messages.mark_as', 'message_threads.customer_id', 'message_threads.merchant_id',
            'messages.created_at', 'messages.thread_id')
            ->leftJoin('messages', 'messages.thread_id', '=', 'message_threads.id')
            ->where('message_threads.customer_id', '=', $this->data['customerValues']->id)
            ->where('message_threads.detail_id', '=', $this->data['customerValues']->detail_id)
            ->orderBy('messages.created_at', 'desc')
            ->get()
            ->unique('thread_id');

        $this->data['unreadMessages'] = $this->unreadMessages($this->data['customerValues']);

        return view('customer-app.message.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['unreadMessages'] = $this->unreadMessages($this->data['customerValues']);
        $this->data['admins'] = GymMerchantRole::select('merchants.id as id', 'merchants.first_name', 'merchants.last_name')
            ->join('gym_merchant_role_users', 'gym_merchant_role_users.role_id', '=', 'gym_merchant_roles.id')
            ->join('merchants', 'merchants.id', '=', 'gym_merchant_role_users.user_id')
            ->join('gym_merchant_role_permissions', 'gym_merchant_role_permissions.role_id', '=', 'gym_merchant_role_users.role_id')
            ->join('gym_merchant_permissions', 'gym_merchant_permissions.id', '=', 'gym_merchant_role_permissions.permission_id')
            ->where('gym_merchant_roles.detail_id', '=', $this->data['customerValues']->detail_id)
            ->where('gym_merchant_permissions.name', '=', 'message')
            ->get();

        return view('customer-app.message.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SendMailRequest $request)
    {
        $messageThread = new MessageThread();
        $messageThread->customer_id = $this->data['customerValues']->id;
        $messageThread->merchant_id = $request->admin_id;
        $messageThread->detail_id = $this->data['customerValues']->detail_id;
        $messageThread->save();

        $message = new Message();
        $message->thread_id = $messageThread->id;
        $message->to = 'merchant';
        $message->from = 'customer';
        $message->text = $request->text;
        $message->save();

        //region Notification
        $notification = new MerchantNotification();
        $notification->detail_id = $this->data['customerValues']->detail_id;
        $notification->notification_type = 'Messages';
        $notification->title = 'New message in the inbox';
        $notification->save();
        //endregion

        return Reply::redirect(route('customer-app.message.index'), 'Message Sent successfully');
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

        $this->data['messages'] = MessageThread::select('messages.to', 'messages.from',
            'messages.text', 'messages.mark_as', 'message_threads.customer_id', 'message_threads.merchant_id',
            'messages.created_at', 'messages.thread_id')
            ->leftJoin('messages', 'messages.thread_id', '=', 'message_threads.id')
            ->where('customer_id', '=', $this->data['customerValues']->id)
            ->where('detail_id', '=', $this->data['customerValues']->detail_id)
            ->where('messages.thread_id', '=', $id)
            ->orderBy('messages.created_at', 'asc')
            ->get();
        $this->data['unreadMessages'] = $this->unreadMessages($this->data['customerValues']);

        return view('customer-app.message.show', $this->data);
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
        $message->to = 'merchant';
        $message->from = 'customer';
        $message->text = $request->message;
        $message->mark_as = 'unread';
        $message->save();

        //region Notification
        $notification = new MerchantNotification();
        $notification->detail_id = $this->data['customerValues']->detail_id;
        $notification->notification_type = 'Messages';
        $notification->title = 'New message in the inbox';
        $notification->save();
        //endregion

        return Reply::dataOnly(['message' => $message->text]);
    }

    /**
     * @param $customerValue
     * @return int
     */
    private function unreadMessages($customerValue)
    {
        return MessageThread::leftJoin('messages', 'messages.thread_id', '=', 'message_threads.id')
            ->where('message_threads.customer_id', '=', $customerValue->id)
            ->where('message_threads.detail_id', '=', $customerValue->detail_id)
            ->where('messages.to', '=', 'customer')
            ->where('messages.mark_as', '=', 'unread')
            ->count();
    }
}
