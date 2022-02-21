<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'twitter',
        'facebook',
        'instagram',
        'youtube',
        'whatsapp',
        'snapchat',
        'email1',
        'email2',
        'phone1',
        'phone2',
        'cellphone1',
        'cellphone2',
        'address',
        'terms_of_use',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'info';
}
