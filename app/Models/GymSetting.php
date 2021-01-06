<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymSetting extends Model
{

    protected $table = 'gym_settings';

    protected $guarded = ['id'];


    public static function GetMerchantInfo($id) {
        return GymSetting::where('detail_id', '=', $id)->first();
    }

    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public static function rules($action) {
        $rules = [
            'add' => [
                'mobile' => 'required',
                'address' => 'required',
                'gstin' => 'nullable|size:15',
            ],
            'image' => [
                'file' => 'image',
            ],
            'update' => [
                'gstin' => 'required|size:15',
            ],
            'id' => [
                'id' => 'required',
            ]
        ];

        return $rules[$action];

    }

}
