<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantPromotionDatabase extends Model
{
    protected $table = "merchant_promotion_database";

    public static function rules($action, $id) {
        $rules = [
            'add' => [
                'name' => 'required',
                'email' => 'required|email|unique:merchant_promotion_database,email',
                'mobile' => 'required|unique:merchant_promotion_database,mobile',
                'gender' => 'required',
                'age' => 'numeric',
            ],
            'edit' => [
                'name' => 'required',
                'email' => 'required|email|unique:merchant_promotion_database,email,' . $id,
                'mobile' => 'required|unique:merchant_promotion_database,mobile,' . $id,
                'gender' => 'required',
                'age' => 'numeric',
            ]

        ];
        return $rules[$action];
    }

}
