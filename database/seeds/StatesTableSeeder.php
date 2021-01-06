<?php

use Illuminate\Database\Seeder;
use App\Models\State;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->delete();

        $states = [
            'Andaman and Nicobar Islands' => 'AN',
            'Andhra Pradesh' => 'AP',
            'Arunachal Pradesh' => 'AR',
            'Assam' => 'AS',
            'Bihar' => 'BR',
            'Chandigarh' => 'CH',
            'Chhattisgarh' => 'CG',
            'Dadra and Nagar Haveli' => 'DN',
            'Daman and Diu' => 'DD',
            'National Capital Territory of Delhi' => 'DL',
            'Goa' => 'GA',
            'Gujarat' => 'GJ',
            'Haryana' => 'HR',
            'Himachal Pradesh' => 'HP',
            'Jammu and Kashmir' => 'JK',
            'Jharkhand' => 'JH',
            'Karnataka' => 'KA',
            'Kerala' => 'KL',
            'Lakshadweep' => 'LD',
            'Madhya Pradesh' => 'MP',
            'Maharashtra' => 'MH',
            'Manipur' => 'MN',
            'Meghalaya' => 'ML',
            'Mizoram' => 'MZ',
            'Nagaland' => 'NL',
            'Odisha' => 'OD',
            'Puducherry' => 'PY',
            'Punjab' => 'PB',
            'Rajasthan' => 'RJ',
            'Sikkim' => 'SK',
            'Tamil Nadu' => 'TN',
            'Telangana' => 'TS',
            'Tripura' => 'TR',
            'Uttar Pradesh' => 'UP',
            'Uttarakhand' => 'UK',
            'West Bengal' => 'WB'
        ];

        $country = DB::table('countries')->first();
        foreach ($states as $state => $code) {
            State::create([
                'country_id' => $country->id,
                'name' => $state,
                'state_code' => $code
            ]);
        }
    }
}
