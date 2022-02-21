<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hour', 'day_id'
    ];

    public function day()
	{
		return $this->belongsTo('App\Day');
	}
}
