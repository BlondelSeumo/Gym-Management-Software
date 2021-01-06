<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMailFileUploadAndMapsCredentialsToGymSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gym_settings', function (Blueprint $table) {
            $table->string('mail_driver')
                ->after('gstin')
                ->nullable();
            $table->string('mail_host')
                ->after('mail_driver')
                ->nullable();
            $table->string('mail_port')
                ->after('mail_host')
                ->nullable();
            $table->string('mail_username')
                ->after('mail_port')
                ->nullable();
            $table->string('mail_password')
                ->after('mail_username')
                ->nullable();
            $table->string('mail_encryption')
                ->after('mail_password')
                ->nullable();
            $table->string('file_storage')
                ->after('mail_encryption')
                ->nullable();
            $table->string('aws_key')
                ->after('file_storage')
                ->nullable();
            $table->string('aws_secret')
                ->after('aws_key')
                ->nullable();
            $table->string('aws_region')
                ->after('aws_secret')
                ->nullable();
            $table->string('aws_bucket')
                ->after('aws_region')
                ->nullable();
            $table->string('maps_api_key')
                ->after('aws_bucket')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gym_settings', function (Blueprint $table) {
            //
        });
    }
}
