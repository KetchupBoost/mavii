<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token', 'platform', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
