<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'week_day_number', 'slug', 'user_id'
    ];

    public function user()
	{
		return $this->belongsTo('App\User');
	}

    public function hours()
    {
        return $this->hasMany('App\Hour');
    }
}
