<?php namespace App\Models;


class Gym extends \Eloquent{

    protected $table = "gyms";

	// Add your validation rules here
	public static $rules = [
	];

	public function facilities()
	{
		return $this->belongsTo(Common::class,'detail_id');
	}

    /*query functions*/
    public static function gymDetail($id)
    {
        return Gym::where('detail_id', '=', $id)->first();
    }

	public function amenities()
	{
		$amenity_string = "";
		if($this->spa_hot_tub == 1)
		{
			$amenity_string .= "Spa/Hot Tub, ";
		}

		if($this->sauna_steam_bath == 1)
		{
			$amenity_string .= "Sauna/Steam Bath, ";
		}

		if($this->massage == 1)
		{
			$amenity_string .= "Massage, ";
		}

		if($this->therapies == 1)
		{
			$amenity_string .= "Therapies, ";
		}

		if($this->cardio == 1)
		{
			$amenity_string .= "Cardio, ";
		}

		if($this->aerobics == 1)
		{
			$amenity_string .= "Aerobics, ";
		}


		if($this->yoga == 1)
		{
			$amenity_string .= "Yoga,";
		}

		if($this->therapies == 1)
		{
			$amenity_string .= "Therapies, ";
		}

		if($this->free_trial == 1)
		{
			$amenity_string .= "Free Trial, ";
		}

		if($this->air_conditioned == 1)
		{
			$amenity_string .= "Air Conditioned, ";
		}

		if($this->towel_service == 1)
		{
			$amenity_string .= "Towel Service, ";
		}

		if($this->shower == 1)
		{
			$amenity_string .= "Shower, ";
		}

		if($this->lockers == 1)
		{
			$amenity_string .= "Lockers, ";
		}

		if($this->juice_bar == 1)
		{
			$amenity_string .= "Juice Bar, ";
		}

		if($this->dietician_nutrition == 1)
		{
			$amenity_string .= "Dietician/Nutrition, ";
		}

		if($this->physiotherapist == 1)
		{
			$amenity_string .= "Physiotherapist, ";
		}

		if($this->personal_trainer == 1)
		{
			$amenity_string .= "Personal Trainer, ";
		}

		return trim($amenity_string,', ');
	}

	public function getZumbaAttribute ()
    {
        return json_decode($this->zumba_data);
    }

    public function getAerobicsDataAttribute ()
    {
        return json_decode($this->aerobics_data);
    }

    public function getYogaDataAttribute()
    {
        return json_decode($this->yoga_data);
    }

    public function getPilateAttribute()
    {
        return json_decode($this->pilate_data);
    }

    public function getSwimAttribute()
    {
        return json_decode($this->swim_data);
    }

    public function getMartialArtAttribute()
    {
        return json_decode($this->martial_art_data);
    }

	// Don't forget to fill this array
	protected $guarded = ['id'];
	
	public static function getMemberships($detail,$key)
	{
		return GymMembership::where('detail_id','=',$detail)->where('title','like','%'.$key.'%')->get();
	}

}