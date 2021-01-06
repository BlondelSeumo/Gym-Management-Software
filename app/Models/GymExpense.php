<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class GymExpense extends Model
{

    protected $table = 'expense_management';

    public static function getExpenses($id) {
        $amount = GymExpense::where('detail_id', '=', $id)
            ->where('created_at', '>', Carbon::now()->subMonths(6)->format('Y-m-d'))
            ->sum('price');

        if(is_null($amount)) {
            return '0';
        }

        return $amount;
    }

    protected $fillable = ['item_name', 'purchase_date', 'purchase_from', 'price', 'bill'];
}
