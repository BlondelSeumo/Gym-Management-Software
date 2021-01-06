<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "contacts";

    public $timestamps = true;

    /*query functions*/

    public static function unreadCount() {
        return Contact::where('admin_read', '=', 'no')
            ->count();
    }

    public static function loadMessage($skip = 0, $take = 2) {
        return Contact::skip($skip)
            ->take($take)
            ->orderby('id', 'desc')
            ->get();

    }

    public static function markMsgRead($msgId) {
        $msg = Contact::find($msgId);

        $msg->admin_read = "yes";

        $msg->save();

    }

    // Don't forget to fill this array
    protected $fillable = ['name', 'email', 'mobile', 'message'];
}
