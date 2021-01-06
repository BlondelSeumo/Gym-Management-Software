<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('alpha_spaces_num', function($attribute, $value)
        {
            return preg_match('/(^[A-Za-z0-9 ]+$)+/', $value);
        });


        Validator::extend('alpha_spaces', function($attribute, $value)
        {
            return preg_match('/(^[A-Za-z ]+$)+/', $value);
        });

        Validator::extend('alpha_spaces_num_spcl', function($attribute, $value)
        {
            return preg_match('/(^[A-Za-z0-9()\/\&<>:., ]+$)+/', $value);
        });

        Validator::extend('num_length', function($attribute, $value, $parameters, $validator)
        {
            // return strlen($value) == $parameters[0];
            $validator->addReplacer('num_length', function($message, $attribute, $rule, $parameters){
                return str_replace([':length'], $parameters, $message);
            });

            return strlen($value) == $parameters[0];
        });

        //Validation for date isn't past today
        Validator::extend('date_check', function($attribute, $value)
        {
            $deadline = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');

            if($deadline <= Carbon::now()->format('Y-m-d')) {
                return false;
            }

            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
