<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function neighborhoods()
    {
        return $this->hasOne('App\Neighborhood');
    }
}
