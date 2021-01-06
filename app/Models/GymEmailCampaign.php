<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymEmailCampaign extends Model
{
    protected $table = 'gym_email_campaign';

    public static $rules = [
        'campaign_name' => 'required',
        'email_title' => 'required'
    ];

    public function template() {
        return $this->belongsTo(GymEmailTemplates::class, 'template_id');
    }

    public static function sentCampaignDetail($businessId, $campaignId) {
        return GymEmailCampaign::where('detail_id', $businessId)
            ->where('status', 'sent')
            ->find($campaignId);
    }

    public static function campaignDetail($businessId, $campaignId) {
        return GymEmailCampaign::where('detail_id', $businessId)
            ->find($campaignId);
    }

    public static function totalSentEmails($businessId) {
        return GymEmailCampaign::where('status', 'sent')
            ->where('detail_id', $businessId)
            ->sum('no_of_emails');
    }

    public static function totalSentCampaigns($businessId) {
        return GymEmailCampaign::where('status', 'sent')
            ->where('detail_id', $businessId)
            ->count();
    }

}
