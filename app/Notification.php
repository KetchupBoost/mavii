<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'link', 'slug', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
