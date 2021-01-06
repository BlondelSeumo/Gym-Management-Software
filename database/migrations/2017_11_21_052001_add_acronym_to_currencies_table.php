<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Currency;

class AddAcronymToCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('currencies', function (Blueprint $table) {
            $table->string('acronym')
                ->after('symbol');
        });

        $currencies = [
            'Indian Rupee' => [
                'fa-inr',
                'INR',
            ],
            'Euro' => [
                'fa-eur',
                'EUR',
            ],
            'British Pound' => [
                'fa-gbp',
                'GBP',
            ],
            'Chinese Yuan' => [
                'fa-jpy',
                'CNY',
            ],
            'Japanese Yen' => [
                'fa-jpy',
                'JPY',
            ],
            'Russian Ruble' => [
                'fa-rub',
                'RUB',
            ],
            'Israeli New Shekel' => [
                'fa-ils',
                'ILS',
            ],
            'South Korean Won' => [
                'fa-krw',
                'KRW',
            ],
            'Turkish Lira' => [
                'fa-try',
                'TRY',
            ],
            'US Dollar' => [
                'fa-usd',
                'USD',
            ],
            'Emirati Dirham' => [
                'fa-money',
                'AED',
            ],
        ];

        foreach ($currencies as $currency => $symbols) {
            Currency::create([
                'name' => $currency,
                'symbol' => $symbols[0],
                'acronym' => $symbols[1],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('currencies', function (Blueprint $table) {
            //
        });
    }
}
