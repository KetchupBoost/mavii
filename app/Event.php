<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'start_hour',
        'end_date',
        'end_hour',
        'professional_start_hour',
        'professional_end_hour',
        'people_amount',
        'location',
        'lat',
        'lng',
        'status',
        'promotion_id',
        'promotion_code',
        'promotion_price',
        'professional_id',
        'slug',
        'event_category_id',
        'user_id'
    ];

    public function event_category()
    {
        return $this->belongsTo('App\EventCategory');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function professional()
    {
        return $this->belongsTo('App\User', 'professional_id', 'id');
    }

    public function event_applications()
    {
        return $this->hasMany('App\EventApplication');
    }

    public function event_application()
    {
        return $this->HasOne('App\EventApplication')->orderBy('event_applications.created_at');
    }

    public function event_logs()
    {
        return $this->hasMany('App\EventLog');
    }
}
