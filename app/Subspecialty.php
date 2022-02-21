<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subspecialty extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'cover', 'slug', 'specialty_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function specialty()
    {
        return $this->belongsTo('App\Specialty');
    }

    public function user_subspecialties()
    {
        return $this->hasMany('App\UserSubspecialty');
    }
}
