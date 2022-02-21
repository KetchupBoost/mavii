<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'icon', 'cover', 'slug', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subspecialties()
    {
        return $this->hasMany('App\Subspecialty');
    }
}
