<?php namespace App\Models;

class Merchantpaymenthistory extends \Eloquent {

	protected $table = "merchant_payments";

	protected $dates = ['paid_on','payment_from','payment_to'];

	protected $guarded = ['id'];

	public function paymentIds()
	{
		return $this->hasMany(Paidpaymenthistory::class,'merchant_payment_id','id');
	}

	public function business()
	{
		return $this->belongsTo(Common::class,'detail_id');
	}

	public static function totalAmountPaid()
	{
		return Merchantpaymenthistory::where('transaction_id','<>','')->sum('paid_amount');
	}

	public static function totalProfit()
	{
		$profit = Merchantpaymenthistory::where('transaction_id','<>','')->sum('profit');
		$loss = Merchantpaymenthistory::where('transaction_id','<>','')->sum('loss');

		$netProfit = $profit-$loss;

		return $netProfit;
	}
}