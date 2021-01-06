<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Notifications\Notifiable;

class Admin extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, EntrustUserTrait, Notifiable;

    protected $table = 'admins';

    public $timestamps = false;

    // Add your validation rules here
    public static $rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required|min:6'
    ];

    protected $fillable = ["email", "password", "name", "status"];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Returns the slack web hook address for user
     * @return mixed
     */
    public function routeNotificationForSlack() {
        return env('SLACK_WEB_HOOK_PATH');
    }

}
