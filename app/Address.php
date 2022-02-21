<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'postal_code', 'public_place', 'street_number', 'neighborhood', 'complement', 'lat', 'lng', 'status', 'slug', 'city_id', 'user_id'
    ];

    public function user()
	{
		return $this->belongsTo('App\User');
	}

    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
