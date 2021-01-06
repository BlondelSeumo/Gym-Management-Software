<?php
namespace App\Traits;

use App\Models\GymSetting;

trait FileSystemSettingTrait{

    public function setFileSystemConfigs(){
        $settings = GymSetting::first();
        if(!is_null($settings)) {
            config(['filesystems.default' => $settings->file_storage]);
            config(['filesystems.s3.key' => $settings->aws_key]);
            config(['filesystems.s3.secret' => $settings->aws_secret]);
            config(['filesystems.s3.region' => $settings->aws_region]);
            config(['filesystems.s3.bucket' => $settings->aws_bucket]);
        }

    }

}