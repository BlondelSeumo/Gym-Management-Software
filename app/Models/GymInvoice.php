<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymInvoice extends Model
{
    protected $table = 'gym_invoice';

    protected $guarded = ['id'];

    protected $dates = ['invoice_date'];

    public static function rules($action){
        $rules = [
            'add' => [
                'client_address' => 'required',
                'client_name' => 'required',
                'invoice_date' => 'required',
                'email' => 'email',
                'mobile' => 'required',
                'generated_by' => 'required'
            ],
            'membership' => [
                'client' => 'required',
                'payment_amount' => 'required',
                'payment_source' => 'required',
                'payment_date' => 'required',
                'purchase_id' => 'required',
                'payment_required' => 'required',
                'payment_type'  => 'required',
                'generated_by' => 'required'
            ]
        ];
        return $rules[$action];
    }

    public function business()
    {
        return $this->belongsTo(Common::class,'detail_id');
    }

    public function items()
    {
        return $this->hasMany(GymInvoiceItems::class,'invoice_id');
    }

    public static function byInvoiceId($invoiceID,$businessID)
    {
        return GymInvoice::with('items')
            ->where('id','=',$invoiceID)
            ->where('detail_id','=',$businessID)
            ->first();
    }

    public static function byBusinessID($businessID)
    {
        return GymInvoice::with('items')
            ->where('detail_id','=',$businessID)
            ->get();
    }
}
