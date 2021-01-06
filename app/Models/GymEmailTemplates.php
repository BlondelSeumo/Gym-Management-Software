<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymEmailTemplates extends Model
{
    protected $table = 'gym_email_campaign_template';

    protected $fillable = ["template_name", "description", "image", "html_template", "preview_template"];
}
