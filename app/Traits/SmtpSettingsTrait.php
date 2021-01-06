<?php
namespace App\Traits;

use App\Models\GymSetting;
use Illuminate\Mail\MailServiceProvider;

trait SmtpSettingsTrait{

    public function setMailConfigs() {
        $settings = GymSetting::first();

        if(!is_null($settings)) {
            (!is_null($settings->mail_driver))? config(['mail.driver' => $settings->mail_driver]): config(['mail.driver' => 'smtp']);
            config(['mail.host' => $settings->mail_host]);
            config(['mail.port' => $settings->mail_port]);
            config(['mail.username' => $settings->mail_username]);
            config(['mail.password' => $settings->mail_password]);
            config(['mail.encryption' => $settings->mail_encryption]);
            config(['mail.from.name' => $settings->mail_name]);
            config(['mail.from.address' => $settings->mail_email]);
        }

        (new MailServiceProvider(app()))->register();
    }

}