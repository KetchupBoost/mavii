<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventLog extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'description', 'event_id'
    ];

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
