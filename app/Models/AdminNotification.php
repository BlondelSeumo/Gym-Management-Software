<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    protected $table = 'admin_notifications';

    public static function unreadCount()
    {
        return AdminNotification::where('read_status','=','unread')
            ->where('created_at','>=',Carbon::now()->subMonth())
            ->count();
    }

    public static function notifications()
    {
        return AdminNotification::orderBy('id','desc')
            ->where('created_at','>=',Carbon::now()->subMonth())
            ->get();
    }

    protected $fillable = ['title','notification_type','read_status'];
}
