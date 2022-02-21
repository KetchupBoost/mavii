<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubspecialty extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subspecialty_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subspecialty()
    {
        return $this->belongsTo('App\Subspecialty');
    }
}
