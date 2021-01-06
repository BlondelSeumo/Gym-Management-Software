<?php

namespace App\Http\Requests\GymAdmin\MyBusiness;

use App\Http\Requests\CoreRequest;

class StoreRequest extends CoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        if($this->request->get('updateType') == 'details') {
            $rules = [
                'title' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'email' => 'email'
            ];
        } elseif ($this->request->get('updateType') == 'services') {
            $rules = [
                'spa_hot_tub' => 'required',
                'sauna_steam_bath' => 'required',
                'massage' => 'required',
                'therapies' => 'required',
                'cardio' => 'required',
                'aerobics' => 'required',
                'yoga' => 'required',
                'air_conditioned' => 'required',
                'towel_service' => 'required',
                'shower' => 'required',
                'lokers' => 'required',
                'juice_bar' => 'required',
                'dietician_nutrition' => 'required',
                'physiotherapist' => 'required',
                'personal_trainer' => 'required',
                'trade_mill' => 'required',
                'leg_equipment' => 'required',
                'exercise_bike' => 'required',
                'thigh_equipment' => 'required',
                'bisceps_trainer' => 'required',
                'wrist_forearms' => 'required',
                'abdomen_abs' => 'required',
                'back_shoulder' => 'required',
                'type' => 'required',
                'special_ladies_batch' => 'required',
                'gender' => 'required',
                'sat_closed' => 'required',
                'sun_closed' => 'required',
                'free_trial_days' => 'numeric',
                'fitness_monthly_price' => 'numeric',
                'fitness_quarterly_price' => 'numeric',
                'fitness_halfyearly_price' => 'numeric',
                'fitness_yearly_price' => 'numeric',
                'gym_monthly_price' => 'numeric',
                'gym_quarterly_price' => 'numeric',
                'gym_halfyearly_price' => 'numeric',
                'gym_yearly_price' => 'numeric'
            ];
        } elseif ($this->request->get('updateType') == 'file') {
            $rules = [
                'file' => 'required|mimes:jpeg,jpg,png'
            ];
        }

        return $rules;
    }
}
